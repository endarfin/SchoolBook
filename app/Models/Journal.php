<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Journal extends Model
{
    public function lessons()
    {
        return $this->belongsTo(Lessons::class, 'lessons_id');
    }
}

