<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function execute(){
        if(view()->exists('admin.index')){
            $data = ['title'=>'Панель админимтсратора'];
            return view('admin.index')->with($data);
        }
    }
}
