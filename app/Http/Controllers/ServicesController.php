<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServicesController extends Controller
{
    //
    public function execute(){

        if(view()->exists('admin.services')){
            $service = Service::all();
//            dd($service);
            $data = [
                    'services' => $service,
                    'title' => 'Сервисы'
                    ];
            return view('admin.services')->with($data);
        }
        abort(404);
    }
}
