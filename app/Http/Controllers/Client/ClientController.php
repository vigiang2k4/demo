<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('client.shop.home');
    }

    public function shop(){
        return view('client.shop.shop');
    }
    public function about(){
        return view('client.other.about');
    }
    public function contact(){
        return view('client.other.contact');
    }
}
