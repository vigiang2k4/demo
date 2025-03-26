<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login()
    {
        return view('account.login');
    }
    public function login_()
    {
        
    }
    public function register()
    {
        return view('account.register');
    }
    public function register_()
    {
        
    }
    public function edit()
    {
        return view('account.edit');
    }
    public function update()
    {
        
    }
    public function forgot()
    {
        return view('account.forgot');
    }
    public function forgot_()
    {
        
    }
    public function pasword()
    {
        return view('account.reset');
    }
    public function pasword_()
    {
        
    }
    public function verify()
    {
        
    }
    public function verify_()
    {
        
    }
}
