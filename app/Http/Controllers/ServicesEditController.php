<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Validator;

class ServicesEditController extends Controller
{
    //
    public function execute(Service $service, Request $request){
        if(view()->exists('admin.service_edit')){

            if($request->isMethod('delete')){
                $service->delete();
                return redirect()->route('services')->with('status', 'Запись удалена');
            }




            if($request->isMethod('post')){
                $input = $request->except('_token');

                $messages = [
                            'required'=>'Поле :attribute обязательное к заполнению',
                            'max'=>'Поле :attribute не должно привышать 255 символов'
                            ];

                $validator = Validator::make($input, [
                                                        'name'=>'required|max:255',
                                                        'text'=>'required',
                                                        'icon'=>'required|max:255'
                                                      ], $messages);

                if($validator->fails()){
                    return redirect()->route('servicesEdit', ['service'=>$input['id']])->withErrors($validator)->withInput();
                }

//                dd($input);
                $service->fill($input);

                if($service->update()){
                    return redirect()->route('services')->with('status', 'Страница обновлена');
                }
            }
















            $old = $service->toArray();

            $data = [
                    'title'=>'Редактирование страниц'.$old['name'],
                    'data'=>$old
                    ];

            return view('admin.service_edit')->with($data);
        }
    }
}
