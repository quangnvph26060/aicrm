<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class OrderService
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrderAll()
    {
        try {
            $orders = $this->order->all();
            return $orders;
        } catch (Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
    }

    public function getOrderByUser($id)
    {
        try {
            $orders = $this->order->where('user_id', $id)->get();
            return $orders;
        } catch (Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
    }
    public  function  updateOrder($id)
    {
        try {
            $order = $this->order->find($id);
            return $order;
        } catch (Exception $e) {
            Log::error('Failed to retrieve orders: ' . $e->getMessage());
            throw new Exception('Failed to retrieve orders');
        }
    }

    public function getOrderAmount()
    {
        try {
            $number = $this->order->count();
            $total = $this->order->sum('total_money');

            $result = [
                'number' => $number,
                'total' => $total
            ];
            return $result;
        } catch (Exception $e) {
            Log::error('Failed to count order: ' . $e->getMessage());
            throw new Exception('Failed to count orders');
        }
    }

    public function getMonthlyRevenue()
    {
        $currentYear = date('Y');
        $monthlyRevenue = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_money) as total')
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $months = range(1, 12);
        $monthlyRevenueWithZeroes = [];
        foreach ($months as $month) {
            $monthlyRevenueWithZeroes[$month] = isset($monthlyRevenue[$month]) ? $monthlyRevenue[$month]->total : 0;
        }
        $totalAnnualRevenue = array_sum($monthlyRevenueWithZeroes);

        return [
            'monthlyRevenue' => array_values($monthlyRevenueWithZeroes),
            'totalAnnualRevenue' => $totalAnnualRevenue,
        ];
    }

    public function getTodayRevenueAndOrders()
    {
        $currentDate = date('Y-m-d');
        $todayData = Order::select(
            DB::raw('COUNT(*) as totalOrders'),
            DB::raw('SUM(total_money) as totalMoney')
        )
            ->whereDate('created_at', $currentDate)
            ->first();
        return [
            'totalOrders' => $todayData->totalOrders,
            'totalMoney' => $todayData->totalMoney,
        ];
    }
}
