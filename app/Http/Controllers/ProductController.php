<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\UploadedFile;
class ProductController extends Controller
{


    // show toàn bộ dữ liệu
    public function showData()
    {

        $product = ProductModel::all();
        return view('product.show', compact('product'));
    }

// hiển thị form add
    public
    function getAdd()
    {
        return view('product.add');
    }

// thêm sản phẩm
    public
    function postAdd(ProductRequest $request)
    {
        // return 'thêm sản phẩm ';

        $this->product = new ProductModel();

        $this->product->tensanpham = $request->name;
        if($request->has('anh')){
            $file = $request->anh; // từ input
            $this->product->anhsanpham =$file->getClientOriginalName(); // lấy tên ảnh gốc
            $file->move(public_path('images'),$this->product->anhsanpham); // lưu trữ ảnh
        }
         $request->merge(['anhsanpham'=> $this->product->anhsanpham]);

        $this->product->mota = $request->mota;
        $this->product->giasanpham = $request->gia;

        $this->product->save();
        return redirect()->route('show')->with('msg', 'thêm thành công');

    }

    // xóa sản phẩm
    public function deleteProduct($id)
    {
        // $id đón từ route
        $product = ProductModel::find($id);
        $product->delete();
        return redirect()->route('show')->with('msg', 'xóa thành công');
    }

    //  form cập nhật
    public function editProduct($id)
    {
        $product = ProductModel::find($id);
        return view('product.edit', compact('product'));
    }

    // cập nhật
    public function updateProduct(ProductRequest $request, $id)
    {
        $product = ProductModel::find($id);
       // dd($product);
        $product->tensanpham = $request->name;

        $file = $request->anh; // từ input
       if($request->has('anh')){
           $product->anhsanpham =$file->getClientOriginalName(); // lấy tên ảnh gốc
           $file->move(public_path('images'),$product->anhsanpham); // lưu trữ ảnh
       }else{
           $product->anhsanpham = $request->anhcu;
       }
        $product->mota = $request->mota;
        $product->giasanpham = $request->gia;
        $product->update();
        return redirect()->route('show')->with('msg', 'cập nhật thành công ');
    }
}
