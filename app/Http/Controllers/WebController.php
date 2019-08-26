<?php

namespace App\Http\Controllers;

use App\Category;
use App\HomeSlider;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('index',[
            'categories'=>$category
        ]);
    }

    public function webSession(){
        session(['web_session'=>[
            'home_slider'=>HomeSlider::all()
        ]]);
    }
}
