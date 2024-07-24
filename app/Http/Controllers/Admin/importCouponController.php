<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseDetail;
use App\Models\Import;
use App\Models\ImportCoupon;
use App\Models\Supplier;
use App\Models\SupplierDebtsDetail;
use App\Services\CompanyService;
use App\Services\DebtNccService;
use App\Services\ExpenseService;
use App\Services\ImportProductService;
use App\Services\ProductService;
use App\Services\SupplierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class importCouponController extends Controller
{

    protected $ImportProductService;
    protected $productService;
    protected $expenseService;
    protected $debtNccService;
    protected $supplierService;
    protected $companyService;

    public function __construct(ImportProductService $ImportProductService, ProductService $productService, ExpenseService $expenseService, DebtNccService $debtNccService, SupplierService $supplierService, CompanyService $companyService){
        $this->ImportProductService = $ImportProductService;
        $this->productService = $productService;
        $this->expenseService = $expenseService;
        $this->debtNccService = $debtNccService;
        $this->supplierService = $supplierService;
        $this->companyService = $companyService;
    }
    public function add(Request $request){
        $user = Auth::user();
        $supplier_id = $request->supplier;
        $total = $request->total;
        $data = [
            'user_id' => $user->id,
            'companies_id' => $supplier_id,
            'total' => $total,
            'payment_ncc' => $request->totalncc,
        ];
        $totalncc = $request->totalncc ?  $request->totalncc : 0;
        $congno = $total - $totalncc;
        if($congno > 0){
            $debtncc = $this->debtNccService->getAllSupplierDebt()->pluck('companies_id');
            if($debtncc->contains($supplier_id)){
                $supplier = $this->debtNccService->findCompanyDebtBySupplier($supplier_id);
                $update = [
                    'amount' => $supplier->amount + $congno
                ];
                $this->debtNccService->updateSupplierDebt($update, $supplier_id);
                SupplierDebtsDetail::create([
                    'supplier_debts_id' => $supplier->id ,
                    'content' =>  'Thanh toán thành công',
                    'amount' => $congno,
                ]);
            }else{
                $supplier = $this->companyService->findCompanyById($supplier_id);
                $add = [
                    'companies_id' => $supplier_id,
                    'amount' => $congno,
                    'description' => 'Nợ nhà cung cấp '.$supplier->name.'('.$supplier->phone.')',
                ];
                $debt = $this->debtNccService->addSupplierDebt($add);
                SupplierDebtsDetail::create([
                    'supplier_debts_id' => $debt->id ,
                    'content' =>  'Thanh toán thành công',
                    'amount' => $congno,
                ]);
            }

        }


        if($totalncc > 0){
            $supplier = Supplier::find($supplier_id);
            $expenses = $this->expenseService->getAllExpense()->pluck('supplier_id');
            if($expenses->contains($supplier_id)){
                $expense = $this->expenseService->findExpenseBysupplier($supplier_id);
                $expensedata = [
                    'amount_spent' => $totalncc + $expense->amount_spent,
                ];
                $this->expenseService->updateExpense($expensedata, $supplier_id);
                ExpenseDetail::create([
                    'expense_id' => $expense->id,
                    'content' => 'Thanh toán cho nhà cung cấp '.$supplier->name,
                    'amount' => $totalncc,
                    'date' => Carbon::now()->toDateString(),
                ]);
            }else{
                $add = [
                    'companies_id' => $supplier_id,
                    'content' => 'Thanh toán cho nhà cung cấp '.$supplier->name,
                    'amount_spent' => $totalncc,
                    'date_spent' => Carbon::now()->toDateString(),
                ];
                $expense = $this->expenseService->addExpense($add);
                ExpenseDetail::create([
                    'expense_id' => $expense->id,
                    'content' => 'Thanh toán cho nhà cung cấp '.$supplier->name,
                    'amount' => $totalncc,
                    'date' => Carbon::now()->toDateString(),
                ]);
            }

        }

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
