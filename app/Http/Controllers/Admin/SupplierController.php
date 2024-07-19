<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Supplier;
use App\Services\SupplierService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        try {
            $title = "Nhà cung cấp";
            $suppliers = $this->supplierService->GetAllSupplier();

            if (request()->ajax()) {
                $view = view('admin.supplier.table', compact('suppliers'))->render();
                return response()->json(['success' => true, 'table' => $view]);
            }
            return view('admin.supplier.index', compact('suppliers', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to fetch supplier: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch supplier', 500);
        }
    }

    public function findByPhone(Request $request)
    {
        try {
            $supplier = $this->supplierService->findSupplierByPhone($request->input('phone'));
            $suppliers = new LengthAwarePaginator(
                $supplier ? [$supplier] : [],
                $supplier ? 1 : 0,
                10,
                1,
                ['path' => Paginator::resolveCurrentPath()]
            );
            return view('admin.supplier.index', compact('suppliers'));
        } catch (Exception $e) {
            Log::error('Failed to find supplier: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to find supplier'], 500);
        }
    }

    public function add()
    {
        return view('admin.supplier.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $supplier = $this->supplierService->addSupplier($request->all());
            session()->flash('success', 'Thêm nhà cung cấp thành công');
            return redirect()->route('admin.supplier.index');
        } catch (Exception $e) {
            Log::error('Failed to create supplier: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $suppliers = $this->supplierService->findSupplierById($id);
            return view('admin.supplier.edit', compact('suppliers'));
        } catch (Exception $e) {
            Log::error('Failed to find supplier information');
        }
    }

    public function update($id, Request $request)
    {
        try {
            $supplier = $this->supplierService->updateSupplier($request->all(), $id);
            session()->flash('success', 'Cập nhật thông tin nhà cung cấp thành công');
            return redirect()->route('admin.supplier.index');
        } catch (Exception $e) {
            Log::error('Failed to update supplier information: ' . $e->getMessage());
            return ApiResponse::error('Failed to update supplier information', 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->supplierService->deleteSupplier($id);
            $suppliers = Supplier::orderByDesc('created_at')->paginate(5);
            $table = view('admin.supplier.table', compact('suppliers'))->render();
            $pagination = $suppliers->links('vendor.pagination.custom')->render();

            return response()->json([
                'success' => true,
                'message' => 'Xóa nhà cung cấp thành công!',
                'table' => $table,
                'pagination' => $pagination
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete supplier: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa nhà cung cấp'
            ]);
        }
    }
}
