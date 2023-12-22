<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class registerController extends Controller
{
    public function index()
    {
        return view('admin.page.register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'name' => 'required',
            'password' => 'required|min:8|regex:/[a-zA-Z]/',
        ]);

        $user = new User();
        if ($request->confirmPassword != $request->password) {
            Session::flash('error', 'Password does not match');
            return redirect()->back()->withInput();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        Session::flash('success', 'Register new user successfully');
        return redirect()->back();
    }
}
