<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\DashboardService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $dashboardService, $orderService;
    public function __construct(DashboardService $dashboardService, OrderService $orderService)
    {
        $this->dashboardService = $dashboardService;
        $this->orderService = $orderService;
    }
    public function index()
    {
        try {
            $getMonth = $this->orderService->getMonthlyRevenue();
            $getMonthlyRevenue = $getMonth['monthlyRevenue'];
            $totalAnnualRevenue = $getMonth['totalAnnualRevenue'];
            $clientnumber = $this->dashboardService->getClientNumber();
            $ordernumber = $this->dashboardService->getOrderNumber();
            $amount = $this->dashboardService->getAmountNumber();
            $daily = $this->dashboardService->getDailySale();
            $newClient = $this->dashboardService->getNewestClient();
            $newOrder = $this->dashboardService->getNewestOrder();
            $newStaff = $this->dashboardService->getNewestStaff();

            return view('welcome', compact('clientnumber', 'ordernumber', 'amount', 'daily', 'newClient', 'newOrder', 'newStaff', 'getMonthlyRevenue', 'totalAnnualRevenue'));
        } catch (Exception $e) {
            Log::error('Failed to get statistic this year: ' . $e->getMessage());
            return ApiResponse::error('Failed to get statistic this year', 500);
        }
    }
}
