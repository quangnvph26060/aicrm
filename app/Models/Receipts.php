<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    use HasFactory;

    protected $table = 'receipts';

    protected $fillable = [
        'content',
        'amount_spent',
        'date_spent',
        'receipt_code '
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latastproduct = self::orderBy('id', 'desc')->first();
            $nextNumber = $latastproduct ? ((int)substr($latastproduct->receipt_code, 2)) + 1 : 1;
            $model->receipt_code = 'PT' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }
}
