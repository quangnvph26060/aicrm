<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Responses\ApiResponse;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    //
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $title = 'Danh mục';
        try {
            $category = $this->categoryService->getCategoryAll();
            return view('admin.category.index', compact('category', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to fetch Category: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch Category', 500);
        }
    }
    public function findByName(Request $request)
    {
        $title = 'Danh mục';
        try{
            $category = $this->categoryService->findCategoryByName($request->input('name'));
            return view('admin.category.index', compact('category', 'title'));
        }
        catch(Exception $e)
        {
            Log::error('Failed to fin category: ' .$e->getMessage());
            return ApiResponse::error('Failed to find category', 500);
        }
    }
    public function add(){
        $title = 'Thêm danh mục';
        return view('admin.category.add', compact('title'));
    }
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());
            session()->flash('success', 'Thêm danh mục mới thành công');
            return redirect()->route('admin.category.index');
        } catch (Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            session()->flash('success', 'Xoá danh mục thành công');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Failed to delete category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Danh mục hiện đang có sản phẩm, không thể xóa');
        }
    }

    public function edit($id)
    {
        $title = 'Sửa danh muc';

        try {
            $category = $this->categoryService->findOrFailCategory($id);
            return view('admin.category.detail', compact('category', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to find category: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {

        try {
            $category = $this->categoryService->updateCategory($id, $request->all());
            session()->flash('success', 'Cập nhật danh mục thành công');
            return redirect()->route('admin.category.index');
        } catch (Exception $e) {
            Log::error('Failed to update category: ' . $e->getMessage());
            return ApiResponse::error('Failed to update category', 500);
        }
    }
}
