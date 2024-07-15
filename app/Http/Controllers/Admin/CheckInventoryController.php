<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\CheckDetail;
use App\Services\CheckInventoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckInventoryController extends Controller
{
    protected $checkInventory;
    public function __construct(CheckInventoryService $checkInventory)
    {
        $this->checkInventory = $checkInventory;
    }

    public function index()
    {
        try{
            $check = $this->checkInventory->getAllCheckInventory();
            return view('admin.check.index', compact('check'));
        }
        catch(Exception $e)
        {
            Log::error('Failed to get Check Tickets: ' .$e->getMessage());
            return redirect()->route('admin.check.index')->with('error', 'Failed to get check tickets');
        }
    }

    public function filterCheck(Request $request)
    {
        $phone = $request->input('phone');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        try{
            $check = $this->checkInventory->filterCheck($startDate, $endDate, $phone);
            return view('admin.check.index', compact('check'));
        }
        catch(Exception $e)
        {
            Log::error('Failed to find check ticket: ' .$e->getMessage());
            return redirect()->route('admin.check.index')->with('error', 'Failed to find Check Tickets');
        }
    }

    public function detail($id)
    {
        try{
            $check = $this->checkInventory->getCheckInventoryById($id);
            $details = CheckDetail::where('check_inventory_id', $id)->get();
            // dd($details);
            return view('admin.check.detail', compact('check', 'details'));
        }
        catch(Exception $e)
        {
            Log::error('Failed to get check detail');
            return ApiResponse::error('Check not found', 500);
        }
    }
}
