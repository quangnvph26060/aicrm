<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Categories;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SupplierService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    protected $productService;
    protected $categoryService;
    protected $brandService;
    protected $supplierService;
    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService, SupplierService $supplierService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->supplierService = $supplierService;
    }
    public function index()
    {
        try {
            $title = 'Sản phẩm';
            $product = $this->productService->getProductAll();
            $category = $this->categoryService->getCategoryAll();
            $brand = $this->brandService->getAllBrand();
            return view('admin.product.index', compact('product', 'category', 'brand', 'title'));
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
    public function findByName(Request $request)
    {

        $product = $this->productService->productByName($request->input('name'));
        // $product = new LengthAwarePaginator(
        //     $products ? [$products] : [],
        //     $products ? 1 : 0,
        //     10,
        //     1,
        //     ['path' =>Paginator::resolveCurrentPath()]
        // );

        return view('admin.product.index', compact('product'));
    }
    public function addForm()
    {
        $title = 'Thêm sản phẩm';
        $brand = $this->brandService->getAllBrand();
        $category = $this->categoryService->getCategoryAll();
        return view('admin.product.add', compact('category', 'brand', 'title'));
    }

    public function addSubmit(Request $request)
    {

        try {
            // dd($request->all());
            $product = $this->productService->createProduct($request->all());
            return redirect()->route('admin.product.store')->with('success', 'Thêm thành công !');
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (Exception $e) {
            Log::error('Failed to fetch add products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch add products', 500);
        }
    }

    public function editForm($id)
    {
        $title = 'Sửa sản phẩm';
        $category = $this->categoryService->getCategoryAll();
        $brand = $this->brandService->getAllBrand();
        $products = $this->productService->getProductById($id);
        return view('admin.product.edit', compact('products', 'brand', 'category', 'title'));
    }

    public function update($id, Request $request)
    {
        $product = $this->productService->updateProduct($id, $request->all());
        return redirect()->route('admin.product.store')->with('success', 'Cập nhật sản phẩm thành công');
    }


    public function delete($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('admin.product.store')->with('success', 'Xóa thành công !');
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Sản phẩm đang tồn tại trong đơn hàng, không thể xóa.');
        }
    }
}
