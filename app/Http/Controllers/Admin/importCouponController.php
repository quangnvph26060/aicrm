<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Import;
use App\Models\ImportCoupon;
use App\Services\ImportProductService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class importCouponController extends Controller
{

    protected $ImportProductService;
    protected $productService;
    public function __construct(ImportProductService $ImportProductService, ProductService $productService){
        $this->ImportProductService = $ImportProductService;
        $this->productService = $productService;
    }
    public function add(Request $request){
        $user = Auth::user();
        $supplier_id = $request->supplier;
        $total = $request->total;
        $data = [
            'user_id' => $user->id,
            'supplier_id' => $supplier_id,
            'total' => $total,
            'payment_ncc' => $request->totalncc,
        ];
        $importCoupon = $this->ImportProductService->addImportCoupon($data);
        $import = Import::where('quantity', '>', 0)->get();
        foreach ($import as $key => $value) {
            $data1 = [
                'import_id' => $importCoupon->id,
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'price' => $value->price,
                'old_price' => $value->product->price,
            ];
            $this->ImportProductService->addImportDetail($data1);
            $product = $this->productService->getProductById($value->product_id);
            $data2 = [
                'quantity' => $product->quantity + $value->quantity,
                'price' => $value->price
            ];
            $this->productService->updateProduct($value->product_id, $data2);

        }
        Import::truncate();
        return redirect()->route('admin.importproduct.index')->with('success', 'Nhập hàng thành công');

    }

}
