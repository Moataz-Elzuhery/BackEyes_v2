<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class VerifyUser extends Model
{

    protected  $table = 'verify_user';

    public $timestamps = true;

    protected $fillable = [
       'user_id','code','status'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}
