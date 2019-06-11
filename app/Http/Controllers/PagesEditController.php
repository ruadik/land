<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Validator;

class PagesEditController extends Controller
{
    //
    public function execute(Page $page, Request $request){  // Указываем зависимости от которых зависит данный метод
//        $page = Page::find($id);  //нет необхдимости так как в зависимостях указан уже Page.
//        dd($page);    // так, как в зависимостях указали МОДЕЛЬ, а в сылке переходв указан роут с нужной нам ID, нет необходимости вызывать модель и ее параметры.


        if($request->isMethod('delete')){
            $page->delete();
            return redirect()->route('pages')->with('status', 'Страница удалена');
        }

        $messages = [
            'required'=>'Поле :attribute обязательное к заполнению',
            'max'=>'Поле :attribute не должно привышать 255 символов',
            'unique'=>'Поле :attribute должно быть уникальным'
        ];

        if($request->isMethod('post')){
           $input = $request->except('_token'); //Вытаскиваем все кроме _token тем самым отбрасываем все ЛИШНЕЕ
//            dd($input);
           $validator = Validator::make($input,[
                                                'name'=>'required|max:255',
                                                'alias'=>'required|max:255|unique:pages,alias,'.$input['id'], //указываем ID строки котор нужно исключить при выборе
                                                'text'=>'required'
                                                ], $messages);

        if($validator->fails()){
            return redirect()->route('pagesEdit', ['page'=>$input['id']])->withErrors($validator)->withInput();
            }

        if($request->hasFile('images')){
            $file = $request->file('images');
            $file->move(public_path().'/assets/img/', $file->getClientOriginalName());
            $input['images'] = $file->getClientOriginalName();
            }else{
                $input['images'] = $input['old_images'];
            }

        unset($input['old_images']);

        $page->fill($input);

        if($page->update()){
            return redirect('admin/pages')->with('status', 'Страница обновлена');
            }
        }



        $old = $page->toArray();
//        dd($old);
        if(view()->exists('admin.pages_edit')){

            $data = [
                        'title'=>'Редактирование страницы - ' . $old['name'],
                        'data'=>$old
                    ];
            return view('admin.pages_edit')->with($data);
        }
    }
}
