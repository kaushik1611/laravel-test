<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    protected function createAdmin(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
            $admin = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('admin.login')->with('success', 'Register successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Somethig went wrong', 'error_msg' => $e->getMessage()]);
        }
    }
    public function showCustomerRegisterForm()
    {
        return view('auth.register', ['url' => 'customer']);
    }
    protected function createCustomer(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => null,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('customer.login')->with('success', 'Register successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Somethig went wrong', 'error_msg' => $e->getMessage()]);
        }
    }
}