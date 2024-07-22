<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';

    protected $fillable = [
        'content',
        'supplier_id',
        'amount_spent',
        'date_spent',
        'expense_code'
    ];

    protected $appends  = ['supplier', 'detail'];

    public function getSupplierAttribute(){
        return Supplier::where('id',$this->attributes['supplier_id'])->first();
    }
    public function getDetailAttribute(){
        return ExpenseDetail::where('expense_id',$this->attributes['id'])->get();
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latastproduct = self::orderBy('id', 'desc')->first();
            $nextNumber = $latastproduct ? ((int)substr($latastproduct->expense_code, 2)) + 1 : 1;
            $model->expense_code = 'PC' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }
}
