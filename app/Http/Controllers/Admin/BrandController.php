<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    protected $brandService;
    public function __construct(BrandService $brandService){
        $this->brandService = $brandService;
    }
    public function index(){
        $brand = $this->brandService->getAllBrand();
        return view('Admin.Brand.index', compact('brand'));
    }

    public function addForm(){
       return view('Admin.Brand.add');
    }

    public function add(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'images' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
        ]);

        // Map validated data to the required array format
        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'images' => $validatedData['images'],
        ];

        $brand = $this->brandService->createBrand($data);
        return redirect()->route('admin.brand.store')->with('success', 'Thêm thành công');
     }

     public function edit($id){
        $brand = $this->brandService->getBrandById($id);
       return view('Admin.Brand.edit', compact('brand'));
     }

     public function update($id, Request $request){
        $brand = $this->brandService->updateBrand($id, $request->all());
        return redirect()->route('admin.brand.store')->with('success', 'Sửa thành công');
     }

}
