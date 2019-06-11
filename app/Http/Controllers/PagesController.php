<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use \App\Page; можно и как написано ниже...

class PagesController extends Controller
{
    //
    public function execute(){
        if(view()->exists('admin.pages')){
            $pages = \App\Page::all();
            $data = [
                    'title'=>'Страницы',
                    'pages'=>$pages
                    ];
            return view('admin.pages')->with($data);
        }
        abort(404);
    }
}
