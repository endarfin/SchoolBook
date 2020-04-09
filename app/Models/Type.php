<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    protected $fillable = ['name',];
    protected $table = 'type_users';

    public function users()
    {
        return $this->hasMany(User::Class);
    }

}
