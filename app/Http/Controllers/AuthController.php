<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      public function index(){
          return view('backend.dashboard.index');
      }

      public function login(){
          return view('backend.login');
      }


      public function authenticate(Request $request){
          $request->flash();

          $credentials = $request->only('email','password');
          $remember_me = $request->has('remember_me') ? true:false;

          if(Auth::attempt($credentials,$remember_me)){
              return redirect()->intended(route('admin.index'));
          }else{
              return back()->with('error','Kullanıcı kayıtlı değil');
          }
      }

      public function logout(){
          Auth::logout();
          return redirect(route('admin.login'));
      }
}
