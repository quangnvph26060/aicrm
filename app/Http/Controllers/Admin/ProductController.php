<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Categories;
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
    public function __construct(ProductService $productService, CategoryService $categoryService){
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
        public function index(){
            try {
                 $product = $this->productService->getProductAll();
                 $category = $this->categoryService->getCategoryAll();
                // return view('', compact('product'));
            } catch (ModelNotFoundException $e) {
                $exception = new ProductNotFoundException();
                return $exception->render(request());
            } catch (Exception $e) {
                Log::error('Failed to fetch products: ' . $e->getMessage());
                return ApiResponse::error('Failed to fetch products', 500);
            }

        }
}
