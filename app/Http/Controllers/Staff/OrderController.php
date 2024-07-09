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
            $order = Order::paginate(1);
            return response()->json([
                'data' => $order->items(),
                'current_page' => $order->currentPage(),
                'last_page' => $order->lastPage(),
            ]);
        }
    }
}
