<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'tax_number',
        'bank_account',
        'bank_id',
        'note',
    ];

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function hasRepresentative()
    {
        return $this->supplier()->exists();
    }
}
