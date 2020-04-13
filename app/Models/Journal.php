<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Journal extends Model
{

    public function users()
    {
        return $this->hasManyThrough(User::Class, Lessons::Class, );
    }
}

