<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfoliosEditController extends Controller
{
    public function execute(Portfolio $portfolio, Request $request){

        if($request->isMethod('delete')){
            $portfolio->delete();
            return redirect()->route('portfolios')->with('status', 'Фотография удаленв');
        }




        if($request->isMethod('post')){
            $input = $request->except('_token');
//            dd($input);
            $messages = [
                        'required'=>'Поле :attribute обязательное к заполнению',
                        'max'=>'Поле :attribute не должно привышать 255 символов'
                        ];

            $validator = \Validator::make($input, [
                                                    'name'=>'required|max:255',
                                                    'filter'=>'required|max:255',
//                                                    'images'=>'required'
                                                  ], $messages);

            if($validator->fails()){
                return redirect()->route('portfoliosEdit',['portfolio'=>$input['id']])->withErrors($validator)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->file('images');
                $file->move(public_path().'/assets/img', $file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();
            }else{
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);
//            dd($input);
            $portfolio->fill($input);

            if($portfolio->update()){
                return redirect()->route('portfolios')->with('status', 'Страница обнаовена');
            }
        }







        if(view()->exists('admin.portfolios_edit')){
            $old = $portfolio->toArray();
            $data = [
                        'title'=>'Редактирование фотографии портфолио - '.$old['name'],
                        'data'=>$old
                    ];
            return view('admin.portfolios_edit')->with($data);
        }
        abort(404);
    }
}
