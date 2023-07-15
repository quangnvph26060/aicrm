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
        $title = "Thêm sản phẩm";
        return view('product.add', compact('title'));
    }

// thêm sản phẩm
    public
    function postAdd(ProductRequest $request)
    {
        // return 'thêm sản phẩm ';

        $this->product = new ProductModel();

        $this->product->tensanpham = $request->name;
        if ($request->has('anh')) {
            $file = $request->anh; // từ input
            $this->product->anhsanpham = $file->getClientOriginalName(); // lấy tên ảnh gốc
            $file->move(public_path('images'), $this->product->anhsanpham); // lưu trữ ảnh
        }
        // $request->merge(['anhsanpham'=> $this->product->anhsanpham]);

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
        $title = "Cập nhật sản phẩm";
        $product = ProductModel::find($id);
        return view('product.edit', compact('product', 'title'));
    }

    // cập nhật sản phẩm
    public function updateProduct(Request $request, $id)
    {
        $product = ProductModel::find($id);
        $request->validate([
            'name' => 'required|string|min:6',
            'mota' => 'required|string',
            'gia' => 'required|integer|min:0',
            'anh' => 'nullable|image|max:2048',
        ], [
            'name.required' => ':attribute không để trống ',
            'name.min' => 'Vui lòng nhập trên :min ký tự',
            'mota.required' => ':attribute không để trống ',
            'gia.required' => ':attribute không để trống',
            'gia.integer' => ':attribute phải là sô',
            'gia.min' => ':attribute phải lớn hơn 0',
        ]);
        $product->tensanpham = $request->name;
        // kiểm tra ảnh có tồn tại không
        if ($request->has('anh')) {
            $file = $request->anh; // từ input
            $product->anhsanpham = $file->getClientOriginalName(); // lấy tên ảnh gốc
            $file->move(public_path('images'), $product->anhsanpham); // lưu trữ ảnh
        } else {
//           unset();
            //   $product->anhsanpham = $request->anhcu;
        }
        $product->mota = $request->mota;
        $product->giasanpham = $request->gia;
        $product->update();
        return redirect()->route('show')->with('msg', 'cập nhật thành công ');
    }

    // chức năng  tìm kiếm
    public function searchProduct(Request $request)
    {
        // kiểm tra xem có bấm nut tìm kiếm hay không
        if ($request->post() && !empty($request->inputSearch)) {
            $product = ProductModel::where('tensanpham', 'like', '%' . $request->inputSearch . '%')->get();
            $size = $product->count();
        } else {
            $product = ProductModel::all();
            $size = 0;
        }
        return view('product.show', compact('product', 'size'));

    }
}
