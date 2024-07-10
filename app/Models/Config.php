<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = "config";
    // In your Config model
    protected $fillable = ['logo', 'name', 'email', 'phone', 'bank_account', 'bank_name'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
