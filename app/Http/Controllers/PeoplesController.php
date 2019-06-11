<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class PeoplesController extends Controller
{
    //
    public function execute(){
        if(view()->exists('admin.peoples')){
            $peoples = People::all();
//            dd($peoples);
            $data = [
                        'title'=>'Страница сотрудников',
                        'peoples'=>$peoples
                    ];
            return view('admin.peoples')->with($data);
        }
        abort(404);
    }
}
