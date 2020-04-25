<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class IndexController extends Controller
{

    public function index()
    {
    	return view('teacher.index');
    }
}
