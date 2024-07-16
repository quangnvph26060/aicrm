<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    //
    public function contact(){
        $title = "Hỗ trợ";
        return view('admin.sp.index', compact('title'));
    }
}
