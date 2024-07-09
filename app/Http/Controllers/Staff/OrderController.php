<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        return view("Themes.pages.order.index");
    }

    public function orderFetch(Request $request)
    {
        if ($request->ajax()) {
            $page = 6;
            $orders = Order::paginate($page);
            $formattedOrders = $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'user_name' => $order->user->name,
                    'client_name' => $order->client->name,
                    'total_money' => $order->total_money,
                    'created_at' => $order->created_at,
                    'status' => $order->status,
                    // Thêm các thông tin khác của đơn hàng cần hiển thị
                ];
            });

            return response()->json([
                'data' => $formattedOrders,
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'pageOrder' => $page
            ]);
        }
    }
}
