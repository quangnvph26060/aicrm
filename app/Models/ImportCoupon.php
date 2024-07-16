<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportCoupon extends Model
{
    use HasFactory;
    protected $table = 'import_coupon';

    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    /**
     * Get the user that owns the import coupon.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the import coupon's details.
     */
    public function details()
    {
        return $this->hasMany(b::class, 'phieu_nhap_id');
    }
}
