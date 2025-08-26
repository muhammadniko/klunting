<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nik', 'nama', 'whatsapp', 'password'];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'nik'; // Laravel akan pakai kolom 'nik' untuk login
    }
}

