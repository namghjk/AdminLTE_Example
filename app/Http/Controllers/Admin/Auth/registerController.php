<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class registerController extends Controller
{
    public function index()
    {
        return view('admin.page.auth.register', [
            'title' => 'Register',
        ]);
    }

    public function store(RegisterRequest $request)
    {
       
        if ($request->confirmPassword != $request->password) {
            Session::flash('error', 'Password does not match');
            return redirect()->back()->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
       

        Session::flash('success', 'Register new user successfully');
        return redirect()->back();
    }
}
