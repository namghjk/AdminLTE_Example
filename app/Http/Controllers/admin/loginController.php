<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller{

    public function index(){
        return view('admin.page.login',[
            'title' => 'Login',
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            "email" =>'required|email:filter',
            'password'=>'required|min:8|regex:/[a-zA-Z]/'
        ]);
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