<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    public $timestamps = false;
    protected $fillable = ['name',];
    protected $table = 'courses';

    public function groups()
    {
        return $this->hasMany(Groups::class,'course_id','id');
    }
}
