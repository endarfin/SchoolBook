<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class teacherSubject extends Model
{
    protected $table = 'teacher_subject';

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
