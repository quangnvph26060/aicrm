<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Categories;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    protected $productService;
    protected $categoryService;
    protected $brandService;
    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }
    public function index()
    {
        try {
            $product = $this->productService->getProductAll();
            $category = $this->categoryService->getCategoryAll();
            $brand = $this->brandService->getAllBrand();
            return view('Themes.pages.product.index', compact('product', 'category', 'brand'));
        } catch (ModelNotFoundException $e) {
            $exception = new ProductNotFoundException();
            return $exception->render(request());
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }

    public function addSubmit(Request $request)
    {
        //  dd($request->all());

        try {

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
    public function editForm($id){
        $category = $this->categoryService->getCategoryAll();
        $brand = $this->brandService->getAllBrand();
        $product = $this->productService->getProductById($id);
        return view('Themes.pages.product.edit', compact('product', 'brand', 'category'));
    }

    public function update($id ,Request $request){
        $product = $this->productService->updateProduct($id, $request->all());
        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
    }


    public function delete($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('admin.product.store')->with('success', 'Xóa thành công !');
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }
}
