<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Admin;
use Carbon\Carbon;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Admin Auth Controller
|--------------------------------------------------------------------------
|
| Authentication operations for admin are handled from this controller.
|
*/

interface AdminAuth
{

    public function viewLogin();
    public function handleLogin(Request $request);
}

class AdminAuthController extends Controller implements AdminAuth
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /*
    |--------------------------------------------------------------------------
    | View Login
    |--------------------------------------------------------------------------
    */
    public function viewLogin()
    {

        return view('admin.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Login
    |--------------------------------------------------------------------------
    */
    public function handleLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'exists:admins', 'min:1', 'max:250'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->get('remember'))) {
                return redirect(RouteServiceProvider::ADMIN);
            } else {
                return redirect()->back()->withErrors(['password' => ['Wrong password']])->withInput($request->only('email', 'remember'));
            }
        }
    }
}