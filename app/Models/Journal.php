<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Journal extends Model
{
    public function lesson()
    {
        return $this->belongsTo(Lessons::class, 'lessons_id');
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}

