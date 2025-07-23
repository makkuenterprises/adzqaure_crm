<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $credentials = $request->only('email', 'password');

        // Let's add the status check for better security
        $credentials['status'] = true;

        if (Auth::attempt($credentials)) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials or account is inactive.']);
    }


public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|in:customer,service_provider,partner',
        ]);

      if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);


        // If you want to log in the customer too, uncomment the line below:
                Auth::login($customer);
        // return redirect()->route('login');
        return redirect()->route('login')->with('success', 'Registration successful! Please log in to continue.');
    }


    protected function redirectBasedOnRole(Customer $customer)
    {
        switch ($customer->type) {
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
