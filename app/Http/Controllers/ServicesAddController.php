<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServicesAddController extends Controller
{
    public function execute(Request $request){

        if($request->isMethod('post')){
            $input = $request->except('_token');
//            dd($input);

            $messages = [
                'required'=>'Поле :attribute обязательное к заполнению',
                'max'=>'Поле :attribute не должно привышать 255 символов'
            ];

            $validator = \Validator::make($input,[
                                                    'name'=>'required|max:255',
                                                    'text'=>'required',
                                                    'icon'=>'required|max:255'
                                                 ], $messages);

            if($validator->fails()) {
                return redirect()->route('servicesAdd')->withErrors($validator)->withInput();
            }

            $service = new service();
            $service->fill($input);
            if($service->save()){
                return redirect()->route('services')->with('status', 'Сервис добавлен');
            }
        }











        if(view()->exists('admin.service_add')){
            $data = [
                        'title'=>'Страница добавления сервисов'
                    ];
            return view('admin.service_add')->with($data);
        }
        abort(404);
    }
}
