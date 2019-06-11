<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\People;

class PoplesAddController extends Controller
{
    //
    public function execute(Request $request){

        if($request->isMethod('post')){
            $input = $request->except('_token');

//            dd($input);
            $messages = [
                        'required'=>'Поле :attribute обязательно к заполнению',
                        'unique'=>'Поле :attribute дожно быть уникальным',
                        'max'=>'Поле :attribute не должно привышать 255 символов'
                        ];

            $validator = Validator::make($input, [
                                                    'name'=>'required|max:255|unique:peoples',
                                                    'position'=>'required|max:255',
                                                    'images'=>'required',
                                                    'text'=>'required'
                                                 ],  $messages);

            if($validator->fails()){
                return redirect()->route('peoplesAdd')->withErrors($validator)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img/', $input['images']);
            }

            $people = new people();

            $people->fill($input);

            if($people->save()){
                return redirect()->route('peoples')->with('status', 'Страница добавлена');
            }


//            dd($input);
        }





        if(view()->exists('admin.peoples_add')){
            $data = [
                        'title'=> 'Страница добавления сотрудников'
                    ];
            return view('admin.peoples_add')->with($data);
        }
        abort(404);
    }
}
