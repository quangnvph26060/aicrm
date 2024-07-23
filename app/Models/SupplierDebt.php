<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierDebt extends Model
{
    use HasFactory;

    protected $table = 'supplier_debts';

    protected $fillable = [
        'supplier_id',
        'amount',
        'description',
    ];

    protected $appends = ['supplier', 'detail'];
    public function getSupplierAttribute(){
        return Supplier::where('id',$this->attributes['supplier_id'])->first();
    }
    public function getDetailAttribute(){
        return SupplierDebtsDetail::where('supplier_debts_id', $this->attributes['id'])->get();
    }

}
