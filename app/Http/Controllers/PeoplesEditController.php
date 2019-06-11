<?php

namespace App\Http\Controllers;

use App\People;
use Validator;
use Illuminate\Http\Request;

class PeoplesEditController extends Controller
{
    //
    public function execute(People $people, Request $request){

        if($request->isMethod('delete')){
//            dd($people);
            $people->delete();
            return redirect()->route('peoples')->with('status', 'Страница сотрудника удалена');
        }

        if($request->isMethod('post')){
            $input = $request->except('_token');
//            dd($input);

            $messages = [
                            'required'=>'Поле :attribute обязательное к заполнению',
                            'max'=>'Поле :attribute не должно привышать 255 символов',
                            'unique'=>'Поле :attribute должно быть уникальным'
                        ];

            $validator = Validator::make($input,[
                                                'name'=>'required|max:255|unique:peoples,name,'.$input['id'],
                                                'position'=>'required|max:255',
//                                                'images'=>'required',
                                                'text'=>'required'
                                                ], $messages);

            if($validator->fails()){
                    return redirect()->route('peoplesEdit', ['people'=>$input['id']])->withErrors($validator)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->file('images');
                $file->move(public_path().'/assets/img/', $file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();
//                dd($input['images']);
            }else{
                $input['images'] = $input['old_images'];
            }
            unset($input['old_images']);

//            dd($input);
            $people->fill($input); //не пихнет пока не напишешь  $people->update()

            if($people->update()){
                return redirect()->route('peoples')->with('status', 'Страница обновлена');
            }

        }








        $old = $people->toArray();
//        dd($old);
        if(view()->exists('admin.peoples_edit')){
            $data = [
                        'title'=>'Редактирование страницы сотрудника - '.$old['name'],
                        'data'=>$old
                    ];
            return view('admin.peoples_edit')->with($data);
        }
    }
}
