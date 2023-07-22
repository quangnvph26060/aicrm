<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // show toàn bộ dữ liệu
    public function showData()
    {
        $product = ProductModel::all();
        return view('product.show', compact('product'));
    }

// hiển thị form add
    public function getAdd()
    {
        $title = "Thêm sản phẩm";
        return view('product.add', compact('title'));
    }

// thêm sản phẩm
    public function postAdd(ProductRequest $request)
    {
        $this->product = new ProductModel();
        $this->product->tensanpham = $request->name;
        // xử lý ảnh đã đc đẩy lên hay chưa và kiểm tra có tệp tin  hay không
        if ($request->hasFile('anh') && $request->file('anh')->isValid()) {
            $file = $request->anh; // từ input
            $fileName = time() . '' . $file->getClientOriginalName();
            $this->product->anhsanpham = $file->storeAS('hinh', $fileName, 'public');
        }
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
    public function updateProduct(ProductRequest $request, $id)
    {
        $product = ProductModel::find($id);
        $product->tensanpham = $request->name;
        // kiểm tra ảnh có tồn tại không và kiểm tra ảnh đc đẩy lên serve chua
        if ($request->hasFile('anh') && $request->file('anh')->isValid()) {
            // xóa ảnh cũ khi thực hiện thêm ảnh mới
            $resultDl = Storage::delete('/public/'.$product->anhsanpham);
            if($resultDl){
                $file = $request->anh; // từ input
                $fileName = time(). '' . $file->getClientOriginalName(); // tên gốc của file
                $product->anhsanpham = $file->storeAS('hinh', $fileName, 'public');
            }
        } else {
            // nếu không thêm ảnh mới sẽ lấy luôn ảnh cũ
                $product->anhsanpham = $product->anhsanpham;
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
            $size = $product->count(); // dếm xem có bao nhiêu sản phẩm đc tìm thấy
        } else {
            $product = ProductModel::all();
            $size = 0;
        }
        return view('product.show', compact('product', 'size'));

    }
}
