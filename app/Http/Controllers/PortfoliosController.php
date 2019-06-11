<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfoliosController extends Controller
{
    //
    public function execute(Portfolio $portfolio, Request $request){
        if(view()->exists('admin.portfolios')){
            $portfolio = Portfolio::All();
//            dd($portfolio);
            $data = [
                        'title'=>'Страница портфолио',
                        'portfolios'=>$portfolio
                    ];
//            dd($data);
            return view('admin.portfolios')->with($data);
        }
        abort(404);
    }
}
