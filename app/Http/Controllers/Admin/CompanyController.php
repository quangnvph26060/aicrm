<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Bank;
use App\Models\City;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        try {
            $title = "Nhà cung cấp";
            $cities = City::get();
            $companies = $this->companyService->getAllCompany();
            if (request()->ajax()) {
                $view = view('admin.company.table', compact('companies', 'cities'))->render();
                return response()->json(['success' => true, 'table' => $view]);
            }
            return view('admin.company.index', compact('companies', 'title', 'cities'));
        } catch (Exception $e) {
            Log::error("Failed to find Companies: " . $e->getMessage());
            return ApiResponse::error('Failed to get Companies', 500);
        }
    }

    public function findByName(Request $request)
    {
        try {
            $companies = $this->companyService->getCompanyByName($request->input('name'));
            return view('admin.company.index', compact('companies'));
        } catch (Exception $e) {
            Log::error('Failed to find company: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to find company']);
        }
    }

    public function companyFilter(Request $request)
    {
        $name = $request->input('name_filter'); // Changed from 'name' to 'name_filter'
        $city_id = $request->input('city_id');
        $title = 'Nhà cung cấp';
        $cities = City::get();
        try {
            $companies = $this->companyService->companyFilter($name, $city_id);
            return view('admin.company.index', compact('companies', 'title', 'cities'));
        } catch (Exception $e) {
            Log::error('Failed to find Company: ' . $e->getMessage());
            return redirect()->route('admin.company.index')->with('error', 'Failed to find Company');
        }
    }

    public function add()
    {
        $bank = Bank::get();
        $cities = City::get();
        return view('admin.company.add', compact('bank', 'cities'));
    }

    public function store(Request $request)
    {
        try {
            $companies = $this->companyService->addCompany($request->all());
            session()->flash('success', 'Thêm nhà cung cấp thành công');
            return redirect()->route('admin.company.index');
        } catch (Exception $e) {
            Log::error('Failed to create Companies: ' . $e->getMessage());
            return ApiResponse::error('Failed to create Companies', 500);
        }
    }

    public function edit($id)
    {
        try {
            $cities = City::get();
            $bank = Bank::get();
            $companies = $this->companyService->findCompanyById($id);
            return view('admin.company.edit', compact('companies', 'bank', 'cities'));
        } catch (Exception $e) {
            Log::error('Failed to find company information: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $companies = $this->companyService->updateCompany($request->all(), $id);
            session()->flash('success', 'Cập nhật thông tin nhà cung cấp thành công');
            return redirect()->route('admin.company.index');
        } catch (Exception $e) {
            Log::error('Failed to update company information: ' . $e->getMessage());
            return ApiResponse::error('Failed to update company information', 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->companyService->deleteCompany($id);
            $companies = Company::orderByDesc('created_at')->paginate(10);
            $table = view('admin.company.table', compact('companies'))->render();
            // $pagination = $companies->links('vendor.pagination.custom')->render();

            return response()->json([
                'success' => true,
                'message' => 'Xóa nhà cung cấp thành công',
                'table' => $table,
                // 'pagination' => $pagination,
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete company: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa nhà cung cấp'
            ]);
        }
    }
}
