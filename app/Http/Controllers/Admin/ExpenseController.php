<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ExpenseService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    protected $expenseService;
    public function __construct(ExpenseService $expenseService){
        $this->expenseService = $expenseService;
    }

    public function index(){
        $title = 'Quản lý chi';
        $expenses = $this->expenseService->getAllExpense();
        return view('admin.quanlythuchi.expense.index', compact('expenses', 'title'));
    }

    public function add(){
        $title = 'Quản lý chi';
        return view('admin.quanlythuchi.expense.add', compact( 'title'));
    }

    public function addSubmit(Request $request){
        $currentDate = Carbon::now()->format('Y-m-d');
        $data = [
            'content' => $request->content,
            'amount_spent' => $request->amount_spent,
            'date_spent' => $currentDate
        ];
        $this->expenseService->addExpense($data);
        return redirect()->route('admin.quanlythuchi.expense.index')->with('success', 'Tạo phiếu thành công !');
    }
}
