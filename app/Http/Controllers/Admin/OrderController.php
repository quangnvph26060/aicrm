<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        try {
            $order = $this->orderService->getOrderAll();
            // dd($order);
            return view('Admin.Order.index', compact('order'));
        } catch (Exception $e) {
            Log::error('Failed to fetch Order: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch Order', 500);
        }
    }
    // public function getOrderbyPhone(Request $request)
    // {
    //     $phone = $request->input('phone');
    //     try {
    //         if ($phone) {
    //             $order = $this->orderService->getOrderbyPhone($phone);
    //             return view('Admin.Order.index', compact('order'));
    //         } else {
    //             $order = $this->orderService->getOrderAll();
    //             return view('Admin.Order.index', compact('order'));
    //         }
    //     } catch (Exception $e) {
    //         Log::error('Failed to find orders by phone: ' . $e->getMessage());
    //         return redirect()->route('admin.order.index')->with('error', 'Failed to find orders');
    //     }
    // }

    public function filterOrder(Request $request)
    {
        $phone = $request->input('phone') ?: "";
        $startDate = $request->input('start_date') ?: '0001-01-01';
        $endDate = $request->input('end_date') ?: now()->format('Y-m-d');
        // dd($request->all());
        try {
            $order = $this->orderService->filterOrder($startDate, $endDate, $phone);
            return view('Admin.Order.index', compact('order'));
        } catch (Exception $e) {
            Log::error('Failed to fetch orders by date: ' . $e->getMessage());
            return redirect()->route('admin.order.index')->with('error', 'Failed to fetch orders between dates');
        }
    }

    public function detail($id)
    {
        try {
            $order = $this->orderService->getOrderbyID($id);
            return view('Admin.Order.detail', compact('order'));
        } catch (\Exception $e) {
            Log::error('Failed to find order');
        }
    }
}
