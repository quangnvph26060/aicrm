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
        'code'
    ];

    protected $appends = ['supplier', 'detail'];
    public function getSupplierAttribute(){
        return Supplier::where('id',$this->attributes['supplier_id'])->first();
    }
    public function getDetailAttribute(){
        return SupplierDebtsDetail::where('supplier_debts_id', $this->attributes['id'])->orderBy('created_at', 'desc')->get();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latastcode = self::orderBy('id', 'desc')->first();
            $nextNumber = $latastcode ? ((int)substr($latastcode->code, 2)) + 1 : 1;
            $model->code = 'CN' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }

}
