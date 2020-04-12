<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'course_id',
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'group_id')->withDefault();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::Class, 'group_subject', 'group_id',
            'subject_id');
    }

}
