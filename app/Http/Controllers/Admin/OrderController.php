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
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index(){
        try {
            $order = $this->orderService->getOrderAll();
            // dd($order);
            return view('Admin.Order.index', compact('order'));
       } catch (Exception $e) {
           Log::error('Failed to fetch Order: ' . $e->getMessage());
           return ApiResponse::error('Failed to fetch Order', 500);
       }
    }
}
