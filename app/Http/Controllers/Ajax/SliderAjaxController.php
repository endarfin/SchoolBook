<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\SlidersRepository;
use Illuminate\Http\Request;

class SliderAjaxController extends Controller
{
    private $slidersRepository;

    public function __construct()
    {
        $this->slidersRepository = app(slidersRepository::class);
    }
     public function index()
     {
         $result  = $this->slidersRepository->getAllWithIsPublished();

         if (count($result)){
             return response()->json([
                 'status' => 'true',
                 'result' =>  $result,
             ]);
         }else{
             return response()->json([
                 'status' => 'false',
                 'msg' => 'Не найдено'
             ]);
         }
     }
    public function profile()
    {
        $result  = $this->slidersRepository->getAllWithNotPublished();

        if (count($result)){
            return response()->json([
                'status' => 'true',
                'result' =>  $result,
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'msg' => 'Не найдено'
            ]);
        }
    }
}
