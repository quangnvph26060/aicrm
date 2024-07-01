<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    //
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function index(){
        try {
            $category = $this->categoryService->getCategoryAll();
            return view('');
        } catch (Exception $e) {
            Log::error('Failed to fetch Category: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch Category', 500);
        }
    }
}
