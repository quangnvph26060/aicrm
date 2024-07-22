<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
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
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
    public function index(Request $request)
    {
        try {
            $title = 'Sản phẩm';
            $category = $this->categoryService->getCategoryAll();
            $brand = $this->brandService->getAllBrand();

            if ($request->ajax()) {
                $product = $this->productService->getProductAll();
                $html = view('admin.product.table', compact('product'))->render();
                $pagination = $product->links('vendor.pagination.custom'); // No need to call render() here

                return response()->json([
                    'html' => $html,
                    'pagination' => $pagination
                ]);
            }

            $product = $this->productService->getProductAll();
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
            return redirect()->route('admin.product.store')->with('success', 'Thêm sản phẩm thành công !');
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


    // ProductController.php
    public function delete($id)
    {
        try {
            $this->productService->deleteProduct($id);

            // Lấy lại danh sách sản phẩm sau khi xóa
            $product = Product::orderByDesc('created_at')->paginate(5); // Điều chỉnh số lượng sản phẩm trên mỗi trang nếu cần thiết
            $view = view('admin.product.table', compact('product'))->render(); // Tạo view cho bảng sản phẩm

            return response()->json(['success' => true, 'message' => 'Xóa thành công!', 'table' => $view]);
        } catch (Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Sản phẩm không thể xóa.']);
        }
    }

    public function formimport(){
        return view('admin.product.importexcel');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file')->getRealPath();
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        //  dd(array_slice($rows, 1));
        foreach (array_slice($rows, 1) as $row) {

            if (isset($row[0]) && !empty($row[0])) {
                $brand = Brand::where('name',$row[4] )->first();
                $category = Categories::where('name',$row[5] )->first();
                $data = [
                    'name' => $row[0],
                    'price' => $row[1],
                    'priceBuy' => $row[2],
                    'quantity' => $row[3],
                    'brand_id' =>$brand->id,
                    'category_id' => $category->id,
                    'product_unit' => $row[6],
                    'status' => 'published',
                    'description' => $row[7],
                    'images' => [],
                ];
                $this->productService->createProduct($data);
            }
        }

        return redirect()->route('admin.product.store')->with('success', 'Thêm sản phẩm thành công');

    }
}
