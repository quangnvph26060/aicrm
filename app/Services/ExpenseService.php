<?php

namespace App\Services;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Log;

class ExpenseService
{

    protected $expense;
    public function __construct(Expense $expense){
        $this->expense = $expense;
    }

    public function getAllExpense(){
        try {
            return $this->expense->get();
        } catch (Exception $e) {
            Log::error('Failed to get all expense: ' . $e->getMessage());
            throw new Exception('Failed to get all expense');
        }
    }

    public function addExpense($data){
        try {
            Log::info('Fetching add Expense');
            $expense = $this->expense->create($data);
            return $expense;
        } catch (Exception $e) {
            Log::error('Failed to get add expense: ' . $e->getMessage());
            throw new Exception('Failed to get add expense');
        }
    }



}
