<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDetail extends Model
{
    use HasFactory;
    protected $table = 'check_detail';
    protected $fillable = ['product_id', 'difference', 'check_inventory_id'];

    public function inventory()
    {
        return $this->belongsTo(CheckInventory::class, 'check_inventory_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
