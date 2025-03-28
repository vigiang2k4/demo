<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\User;
use App\Repositories\Account\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    protected $AccountRepo;

    public function __construct(AccountRepository $AccountRepo)
    {
        $this->AccountRepo = $AccountRepo;
    }
    public function login()
    {
        return view('account.login');
    }
    public function login_(AccountRequest $request,)
    {
        try {
            $result = $this->AccountRepo->login($request->validated());

            if (!$result['success']) {
                return back()
                    ->withErrors(['email' => $result['message']])
                    ->withInput();
            }

            $user = $result['user'];

            return $user->role == 1
                ? redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công với tư cách Admin!')
                : redirect()->route('user.dashboard')->with('success', 'Đăng nhập thành công!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Có lỗi xảy ra khi đăng nhập: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function register()
    {
        return view('account.register');
    }
    public function register_(AccountRequest $request)
    {
        try {
            $this->AccountRepo->create($request->validated());
            return redirect()->route('home')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Có lỗi xảy ra khi đăng ký: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function edit()
    {
        return view('account.edit');
    }
    public function update() {}
    public function forgot()
    {
        return view('account.forgot');
    }
    public function forgot_() {}
    public function pasword()
    {
        return view('account.reset');
    }
    public function pasword_() {}
    public function verify() {}
    public function verify_() {}
    public function logout()
    {
        $this->AccountRepo->logout();

        return redirect()->route('home')->with('success', 'Đã đăng xuất thành công!');
    }
}
