<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Login extends Authenticatable
{
    use HasFactory;

    protected $table = 'logins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'usertype',
        'password',
    ];

   
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
