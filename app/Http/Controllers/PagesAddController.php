<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Page;


class PagesAddController extends Controller
{
    //
    public function execute(Request $request){

        if($request->isMethod("post")){
            $input = $request->except('_token');
//            dd($input);
            $messages = [
                            'required'=>'Поле :attribute обязательное к заполнению',
                            'max'=>'Поле :attribute не должно привышать 255 символов'
            ];

            $validator = Validator::make($input,
                                                [
                                                   'name'=>'required|max:255',
                                                   'alias'=>'required|max:255|unique:pages',
                                                   'text'=>'required',
                                                   'images'=>'required'
                                                ],  $messages);
//            dd($validator);
            if($validator->fails()){
                return redirect()->route('pagesAdd')->withErrors($validator)->withinput();
                }

            if($request->hasFile('images')){
                ///////////////////////////Сохранение изоброжения в публичный каталог для его отоброжения
                $file = $request->file('images');   //экземпляр объекта uploadetfile
//              dd($file);
                $input['images'] = $file->getClientOriginalName(); //Возвращяет оригинальное имя файла и отрезает все не нужно, так как в БД экземпляр объекта uploadetfile пихать нет смысла
//                dd($input);
                $file->move(public_path().'/assets/img/', $input['images']); //перемещяеть выбранный файл в публичную директорию
                ///////////////////////////////////////////////////////////////////////////////////////////
                }

            $page = new Page();
//            $page->unguard();   //дает полный доступ на добавление в БД в обход МОДЕЛИ
            $page->fill($input);

            if($page->save()){
                return redirect()->route('pagesAdd')->with('status', 'Страница добавлена');
            }


        }


        if(view()->exists('admin.pages_add')){
            $data = [
                    'title'=>'Новая страница'
                    ];
            return view('admin.pages_add')->with($data);
            }
        abort(404);
    }
}
