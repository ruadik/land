<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Service;
use App\People;
use App\Portfolio;
use Illuminate\Support\Facades\DB;
use Dotenv\Validator;
use Mail;

use function MongoDB\BSON\fromPHP;

class IndexController extends Controller
{
    //
    public function execute(Request $request){






        if($request->isMethod('post')){

            $message = [
                'required'=>'Поле :attribute обязательно к заполнениею',
                'email'=>'Полей :attribute должно соответсвывать email адресу',
//            'max'=>'Максимальное значение поля :attribute не долно превышать 255 символов'
            ];

            $this->validate($request, [
                'name'=>'required|max:255',
                'email'=>'required|email',
                'text'=>'required'
            ], $message);

//            dump($request);

            //mail
        $data = $request->all();
//            dump($data);
        $result = Mail::send('site.email', ['data'=>$data], function ($massage) use ($data){
                $mail_admin = env('MAIL_ADMIN');
                $massage -> from($data['email'], $data['name']);
                $massage -> to($mail_admin, 'Mr. Admin')->subject('Question');
            });

//        dump($result);

            if($result == null){
                return redirect()->route('general')->with('status', 'Email is send');
            }


        }


        $pages = Page::all();
        $services = Service::all();
        $portfolios = Portfolio::all();
        $peoples = People::all();

        $tags = DB::table('portfolio')->select('filter')->distinct()->get(); //не выводит одинаковые значения
//        dd($tags);

        $menu = array();
        foreach ($pages as $page){
            $item = array('title'=>$page->name, 'alias' => $page->alias);
            array_push($menu, $item);
        }

        $item = array('title'=>'Services', 'alias'=>'service');
        array_push($menu, $item);

        $item = array('title'=>'Portfolio', 'alias'=>'Portfolio');
        array_push($menu, $item);

        $item = array('title'=>'Team', 'alias'=>'team');
        array_push($menu, $item);

        $item = array('title'=>'Contact', 'alias'=>'contact');
        array_push($menu, $item);

//        dd($menu);

        return view('site.index', array(
                                                'menu'=>$menu,              //содержит в себе массив имен ссылок и их ID
                                                'pages'=>$pages,            //передаем результат запроса
                                                'services'=>$services,
                                                'portfolios'=>$portfolios,
                                                'peoples'=>$peoples,

                                                'tags'=>$tags,
                                            ));

//        return view('layouts.site2');
    }


}
