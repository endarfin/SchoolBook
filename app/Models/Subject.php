<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    public $timestamps = false;
    protected $fillable = ['name',];

    public function users()
    {
        return $this->belongsToMany(User::Class, 'teacher_subject', 'subject_id', 'user_id');
    }
}
