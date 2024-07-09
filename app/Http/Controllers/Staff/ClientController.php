<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Cart;
use App\Models\Order;
use App\Services\ClientService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;


// Import the PDF facade
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
// Import the Storage facade

class ClientController extends Controller
{
    //
    protected $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function addClient(Request $request)
    {
        try {
            $listphone = $this->clientService->getAllClient()->pluck('phone');
            if ($listphone->contains($request->phone)) {
                return redirect()->back()->with('fail', 'Khách hàng đã tồn tại ');
            }
            $client = $this->clientService->addClient($request->all());
            return redirect()->back()->with('action', 'Thêm khách hàng thành công');
        } catch (Exception $e) {
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch clients', 500);
        }
    }

    public function submitOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $listphone = $this->clientService->getAllClient()->pluck('phone');
            if ($listphone->contains($request->phone)) {
                $client = $this->clientService->findClientByPhone($request->phone);
                $cartItems = Cart::where('user_id', $user->id)->get();
            } else {
                $client = $this->clientService->addClient($request->all());
            }
        } catch (Exception $e) {
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch clients', 500);
        }
    }


    public function bill($file){
        $response = Response::download(public_path($file))->deleteFileAfterSend(true);

        return $response;
    }
    public function pay(Request $request)
    {
        try {
            $user = Auth::user();
            $listphone = $this->clientService->getAllClient()->pluck('phone');
            $cartItems = Cart::where('user_id', $user->id)->get();
            $sum = 0;
            $client= array();
            foreach ($cartItems as $key => $item) {
                $sum += $item->product->priceBuy * $item->amount;
            }
            if ($listphone->contains($request->phone)) {
                $client = $this->clientService->findClientByPhone($request->phone);
                Order::create([
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'total_money' => $sum,
                    'status' => 1
                ]);
            } else {
                $client = $this->clientService->addClient($request->all());
                Order::create([
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'total_money' => $sum,
                    'status' => 1
                ]);
            }
            Cart::where('user_id', $user->id)->delete();
            $html = view('Themes.pages.bill.index', compact('cartItems','sum', 'client', 'user'))->render();
            $pdf = Pdf::loadHTML($html);
            $pdfFileName = 'order.pdf';
            $pdf->save(public_path($pdfFileName));
            $response = $this->bill($pdfFileName);
            Session::flash('action', 'Thanh toán thành công');

            // return $response;
            return response()->json([
                'pdf_url' => asset($pdfFileName),
                'message' => 'Thanh toán thành công'
            ]);
        } catch (Exception $e) {
            Log::error('Failed to process payment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to process payment'], 500);
        }
    }

    public function cart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->priceBuy;
        });

        // Trả về dữ liệu giỏ hàng và tổng tiền dưới dạng JSON
        return response()->json([
            'cart' => $cartItems,
            'totalAmount' => $totalAmount,
        ]);
    }
}
