<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;

    protected $table = 'import_detail';

    protected $fillable = [
        'import_id',
        'product_id',
        'quantity',
        'price',
        'old_price'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function import(){
        return $this->belongsTo(ImportCoupon::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
