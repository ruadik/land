<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;

class PortfoliosAddController extends Controller
{
    //
    public function execute(Request $request){

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
                                                    'images'=>'required'
                                                  ], $messages);
            if($validator->fails()){
                return redirect()->route('portfoliosAdd')->withErrors($validator)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'assets/img/',$input['images']);
            }

            $portfolio = new portfolio();
            $portfolio->fill($input);

            if($portfolio->save()){
                return redirect()->route('portfolios')->with('status', 'Фотография добавлена');
            }

        }






        if(view()->exists('admin.portfolios_add')){
            $data = [
                        'title'=>'Добавление новой фотографии'
                    ];
            return view('admin.portfolios_add')->with($data);
        }
    }
}
