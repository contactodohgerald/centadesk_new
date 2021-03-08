<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //

    public function aboutUsPage(){
        return view('front-end.about');
    }

    public function contactUsPage(){
        return view('front-end.contact');
    }

    public function faqPage(){
        return view('front-end.faq');
    }
}
