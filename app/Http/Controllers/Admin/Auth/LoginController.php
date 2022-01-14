<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    protected function guard()
     {
         //adminという権限の付与
         return Auth::guard('admin');
         
     }

     //ログインフォームのview指定
     public function showLoginForm()
     {
         return view('admin.auth.login');
     }

     //ログアウトの処理
     public function logout(Request $request)
     {
         Auth::guard('admin')->logout();
         return $this->loggedOut($request);
     }

     //ログアウト時のリダイレクト先
     public function loggedOut(Request $request)
     {
         return redirect(route('admin.login'));
     }
}
