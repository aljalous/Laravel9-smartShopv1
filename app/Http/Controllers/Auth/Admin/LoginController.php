<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Notifications\VerifyRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/admin';


    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }


    protected function guard()
    {
      return Auth::guard('admin');
    }


    public function showLoginForm()
    {
      if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.index');
      }

      return view('auth.admin.login');
    }

    
    public function login(Request $request)
    {
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
      ]);

      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // Log Him Now
        return redirect()->intended(route('admin.index'));
      } else {
        session()->flash('sticky_error', 'Invalid Login');
        return back();
      }
    }

    public function logout(Request $request)
    {
      $this->guard()->logout();

      $request->session()->invalidate();

      return redirect()->route('admin.login');
    }
}
