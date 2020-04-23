<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sliders extends Model
{
    use SoftDeletes;
    protected $table = 'sliders';
    protected $fillable =['id','url','is_published'];
}
