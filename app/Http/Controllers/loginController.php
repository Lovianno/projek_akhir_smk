<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function authenticate(Request $request){
        $data =  $request->validate([
             'username' => ['required'],
             'password' => ['required']
         ]);
         if (Auth::attempt($data)) {
             $request->session()->regenerate();
  
             return redirect()->intended('/data-barang');
         }
  
         return back()->withErrors([
             'username' => 'Username atau Password Salah !!',
         ]);
     }
      public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
      }
}
