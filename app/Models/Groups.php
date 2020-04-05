<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'course_id',
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

}
