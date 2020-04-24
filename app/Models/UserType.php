<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'type_user_id'];
    protected $table = 'type_users';

    public function users()
    {
        return $this->hasMany(User::Class);
    }
}
