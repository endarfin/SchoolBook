<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lessons extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date_event',
        'group_id',
        'subject_id',
        'user_id',
        'class_room_id',
    ];

    public function Groups()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function Users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function ClassRooms()
    {
        return $this->belongsTo(ClassRooms::class, 'class_room_id');
    }

}
