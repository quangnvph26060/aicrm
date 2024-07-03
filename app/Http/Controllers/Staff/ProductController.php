<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(){
        $product = $this->productService->getProductAll();
        return view('Themes.pages.layout_staff.index', compact('product'));
    }
}
