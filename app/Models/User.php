<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'name', 'surname', 'phone', 'type_user_id', 'email', 'password', 'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setIdGroupAttribute($value){
        $this->attributes['group_id'] = $value;

    }



    public function type()
    {
        return $this->belongsTo(Type::Class, 'type_user_id');
    }
    public function group()
    {
       return $this->belongsTo(Groups::Class, 'group_id')->withDefault();
    }
    public function subjects()
    {
       return $this->belongsToMany(Subject::Class, 'teacher_subject', 'user_id', 'subject_id');
    }



    public function isAdministrator()
    {
        return $this->type()->where('id', '3')->exists();
    }

    public function isTeacher()
    {
        $teacher = $this->type()->where('id', '2')->exists();
        if ($teacher) return "Teacher";
    }

    public function isStudent()
    {
        $student = $this->type()->where('id', '1')->exists();
        if ($student) return "Student";
    }

    public function isVisitor()
    {
        $user = $this->type()->where('id', '')->exists();
        if ($user) return "user";
    }


}
