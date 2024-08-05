<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\ImportCoupon;
use App\Models\Product;
use App\Models\Storage;
use App\Services\ProductService;
use App\Services\ProductStorageService;
use App\Services\ProfitService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    protected $productStorageService;
    protected $productService;
    protected $profitService;
    public function __construct(ProductStorageService $productStorageService, ProductService $productService, ProfitService $profitService)
    {
        $this->productStorageService = $productStorageService;
        $this->productService = $productService;
        $this->profitService = $profitService;
    }

    public function index()
    {
        try {
            $title = 'Báo cáo xuất nhập tồn';
            $storages = Storage::orderBy('name', 'asc')->get();
            $storage = Storage::first();
            $storage_id = $storage->id;
            $products = $this->productStorageService->inventoryReport($storage_id);

            // Lấy thêm thông tin kho và ngày tạo phiếu nhập
            $latestImportCoupon = ImportCoupon::where('storage_id', $storage_id)
                ->orderBy('created_at', 'desc')
                ->first();
            $latestImportDate = $latestImportCoupon ? $latestImportCoupon->created_at : null;
            $yesterday = now()->subDay()->toDateString();

            return view('admin.inventory.index', compact('title', 'products', 'storages', 'storage', 'latestImportDate', 'yesterday'));
        } catch (Exception $e) {
            Log::error('Failed to get Inventory Report: ' . $e->getMessage());
            return ApiResponse::error('Failed to get Inventory Report', 500);
        }
    }

    public function getReportByStorage(Request $request)
    {
        try {
            $storage_id = $request->storage_id;
            $products = $this->productStorageService->inventoryReport($storage_id);

            // Additional information
            $storage = Storage::find($storage_id);
            $latestImportCoupon = ImportCoupon::where('storage_id', $storage_id)
                ->orderBy('created_at', 'desc')
                ->first();
            $latestImportDate = $latestImportCoupon ? $latestImportCoupon->created_at : null;
            $yesterday = now()->subDay()->toDateString();

            return response()->json([
                'products' => $products,
                'storage' => $storage,
                'latestImportDate' => $latestImportDate,
                'yesterday' => $yesterday
            ]);
        } catch (Exception $e) {
            Log::error('Failed to get Inventory Report: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get Inventory Report'], 500);
        }
    }

    public function profitIndex()
    {
        try {
            $title = 'Báo cáo lợi nhuận';
            $storages = Storage::orderBy('name', 'asc')->get();
            $storage = Storage::first();
            $storage_id = $storage->id;
            $profits = $this->profitService->profitReport(1, $storage_id);
            return view('admin.profit.index', compact('title', 'profits', 'storages'));
        } catch (Exception $e) {
            Log::error('Failed to get Profit Report: ' . $e->getMessage());
            return ApiResponse::error('Failed to get Profit Report', 500);
        }
    }

    public function getProfitReportByFilter(Request $request)
    {
        try {
            $storage_id = $request->input('storage_id');
            $filter = $request->input('filter');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            // Kiểm tra các giá trị đầu vào
            if ($filter == 6 && ($start_date === null || $end_date === null)) {
                return response()->json(['error' => 'Vui lòng chọn ngày bắt đầu và kết thúc'], 400);
            }

            $profits = $this->profitService->profitReport($filter, $storage_id, $start_date, $end_date);

            return response()->json([
                'profits' => $profits,
            ]);
        } catch (Exception $e) {
            Log::error('Failed to get Profit Report: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get Profit report'], 500);
        }
    }
}
