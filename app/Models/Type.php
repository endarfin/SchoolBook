<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    protected $fillable = ['name',];
    protected $table = 'type_users';


    public function user()
    {
        return $this->belongsTo('App\Models\User','type_user_id');
    }
}
