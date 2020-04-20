<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class groupSubject extends Model
{
    protected $table = 'group_subject';

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
