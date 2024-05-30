<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expires_at'];
//    protected $appends = ['user_info'];
//    public function getUserInfoAttribute()
//    {
//        return User::where('id', $this->attributes['user_id'])->first();
//    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
