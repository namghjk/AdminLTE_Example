<?php


namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller{

    public function index(){
        return view('admin.page.auth.login',[
            'title' => 'Login',
        ]);
    }

    public function store(LoginRequest $request){
   
        if(Auth::attempt([
            'email' =>$request->input('email'),
            'password' =>$request->input('password'),
        ],$request->input('remember'))){
            Session::flash('success', 'Login Successfully');
            return redirect()->route('admin');
        }

        Session::flash('error','Email or Password Invalid');
        return redirect()->back();
    }
}