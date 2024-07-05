<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\DashboardService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $dashboardService;
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index()
    {
        try {
            $clientnumber = $this->dashboardService->getClientNumber();
            $ordernumber = $this->dashboardService->getOrderNumber();
            $amount = $this->dashboardService->getAmountNumber();
            $daily = $this->dashboardService->getDailySale();
            $newClient = $this->dashboardService->getNewestClient();
            $newOrder = $this->dashboardService->getNewestOrder();
            $newStaff = $this->dashboardService->getNewestStaff();
            return view('welcome', compact('clientnumber', 'ordernumber', 'amount', 'daily', 'newClient', 'newOrder', 'newStaff'));
        } catch (Exception $e) {
            Log::error('Failed to get statistic this year: ' . $e->getMessage());
            return ApiResponse::error('Failed to get statistic this year', 500);
        }
    }
}
