<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Customer;


class CommonAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
           $customer = Customer::where('phone', $request->phone)->first();

            if ($customer && Hash::check($request->password, $customer->password)) {
                Auth::guard('customer')->login($customer);

                return redirect()->route('customer.dashboard');
            }



        return redirect()->route('login')->withErrors(['phone' => 'Invalid phone no or password. Please try again.']);
    }

public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users|unique:customers,email',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:customer,service_provider,partner',
    ]);

    if ($validator->fails()) {
        return redirect()->route('register')->withErrors($validator)->withInput();
    }

    if ($request->role === 'customer') {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // If you want to log in the customer too, uncomment the line below:
        Auth::guard('customer')->login($customer);

        return redirect()->route(route: 'customer.dashboard')->with('success', 'Registration successful! Please log in.');
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'role' => $request->role,
    ]);

    Auth::login($user);
    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
}


    protected function redirectBasedOnRole(User $user)
    {
        switch ($user->role) {
            case 'service_provider':
                return redirect()->route('service_provider.dashboard');
            case 'partner':
                return redirect()->route('partner.dashboard');
            case 'customer':
            default:
                return redirect()->route('customer.dashboard');
        }
    }
}
