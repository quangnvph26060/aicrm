<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReceiptsService;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receiptsService;
    public function __construct(ReceiptsService $receiptsService){
        $this->receiptsService = $receiptsService;

    }

    public function index(){
        $title = 'Quản lý thu';
        $receipts = $this->receiptsService->getAllReceipts();
        return view('admin.quanlythuchi.receipt.index', compact('receipts', 'title'));
    }


}
