<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{

    protected  $table = 'reset_code_passwords';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'code',
        'token',
        'user_id'
    ];
}
