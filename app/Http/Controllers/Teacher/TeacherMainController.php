<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class TeacherMainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');



    }
}
