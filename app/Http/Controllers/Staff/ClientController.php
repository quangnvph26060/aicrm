<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Cart;
use App\Models\Config;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ReceiptDetail;
use App\Services\ClientService;
use App\Services\DebtKHService;
use App\Services\ProductService;
use App\Services\ReceiptsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
    protected $productService;
    protected $receiptsService;
    protected $debtKHService;
    public function __construct(ClientService $clientService, ProductService $productService, ReceiptsService $receiptsService, DebtKHService $debtKHService)
    {
        $this->clientService = $clientService;
        $this->productService = $productService;
        $this->receiptsService = $receiptsService;
        $this->debtKHService = $debtKHService;
    }

    public function addClient(Request $request)
    {
        try {

            $listphone = $this->clientService->getAllClientStaff()->pluck('phone');
            if ($listphone->contains($request->phone)) {
                return redirect()->back()->with('fail', 'Khách hàng đã tồn tại');
            } else {
                $client = $this->clientService->addClient($request->all());
                return redirect()->back()->with('action', 'Thêm khách hàng thành công');
            }
        } catch (Exception $e) {
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch clients', 500);
        }
    }

    public function submitOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $listphone = $this->clientService->getAllClientStaff()->pluck('phone');
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


    public function bill($file)
    {
        $response = Response::download(public_path($file))->deleteFileAfterSend(true);

        return $response;
    }
    public function pay(Request $request)
    {
        try {
            $user = Auth::user();
            $listphone = $this->clientService->getAllClientStaff()->pluck('phone');
            $cartItems = Cart::where('user_id', $user->id)->get();
            $sum = 0;
            $client = array();
            $trangthai = $request->status;
            foreach ($cartItems as $key => $item) {
                $sum += $item->product->priceBuy * $item->amount;
                $this->productService->updateProduct($item->product_id, ['quantity' => $item->product->quantity - $item->amount]);
            }
            if ($listphone->contains($request->phone)) {
                $client = $this->clientService->findClientByPhone($request->phone);
                $order = Order::create([
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'total_money' => $sum,
                    'status' => $request->status,
                    'notification' => 1
                ]);
                foreach ($cartItems as $key => $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'quantity' => $item->amount,
                        'product_id' => $item->product_id
                    ]);
                }
            } else {
                $client = $this->clientService->addClient($request->all());
                $order = Order::create([
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'total_money' => $sum,
                    'status' => $trangthai,
                    'notification' => 1
                ]);
                foreach ($cartItems as $key => $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'quantity' => $item->amount,
                        'product_id' => $item->product_id
                    ]);
                }
            }

            if ($trangthai != 4) {
                $listreceipt = $this->receiptsService->getAllReceipts()->pluck('client_id');
                if ($listreceipt->contains($client->id)) {
                    $receipt = $this->receiptsService->findRecieptByClient($client->id);
                    $data1 = [
                        'amount_spent' => $sum + $receipt->amount_spent,
                        'date_spent' => Carbon::now()->toDateString()
                    ];
                    $receipt->updateClientDebt($data1);
                    $detail = [
                        'receipt_id' => $receipt->id,
                        'content' => 'Thu từ khách hàng có số điện thoại ' . $request->phone,
                        'amount' => $sum,
                        'date' => Carbon::now()->toDateString()
                    ];
                    ReceiptDetail::create($detail);
                } else {
                    $data1 = [
                        'client_id' => $client->id,
                        'content' => 'Thu từ khách hàng có số điện thoại ' . $request->phone,
                        'amount_spent' => $sum,
                        'date_spent' => Carbon::now()->toDateString()
                    ];
                    $receipt = $this->receiptsService->addReceipts($data1);
                    $detail = [
                        'receipt_id' => $receipt->id,
                        'content' => 'Thu từ khách hàng có số điện thoại ' . $request->phone,
                        'amount' => $sum,
                        'date' => Carbon::now()->toDateString()
                    ];
                    ReceiptDetail::create($detail);
                }

                $data1 = [
                    'content' => 'Thu từ khách hàng có số điện thoại ' . $request->phone,
                    'amount_spent' => $sum,
                    'date_spent' => Carbon::now()->toDateString()
                ];
                $this->receiptsService->addReceipts($data1);
            } else {
                $ClientDebt = $this->debtKHService->getAllClientDebt()->pluck('client_id');
                if ($ClientDebt->contains($client->id)) {
                    $clientdebt = $this->debtKHService->findClientDebtByClient($client->id);
                    $data2 = [
                        'amount' => $client->amount + $sum,
                    ];
                    $this->debtKHService->updateClientDebt($data2, $client->id);
                } else {
                    $data = [
                        'client_id' => $client->id,
                        'amount' => $sum,
                        'description' => 'Khách có số điện thoại ' . $request->phone
                    ];
                    $this->debtKHService->addClientDebt($data);
                }
            }
            Cart::where('user_id', $user->id)->delete();
            $config = Config::first();
            $html = view('Themes.pages.bill.index', compact('cartItems', 'sum', 'client', 'user', 'config'))->render();
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
