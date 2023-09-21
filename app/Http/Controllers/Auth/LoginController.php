<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('guest:admin')->except('logout');

    }
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }
    public function adminLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with(['errors' =>$validator->errors()]);
            } else {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    return redirect()->route('admin.index')->with('success', 'Login successfully!');
                } else {
                    return redirect()->route('admin.login')->with('error', 'Invalid credentials');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['errors' => 'Somethig went wrong', 'error_msg' => $e->getMessage()]);
        }
    }

    public function showCustomerLoginForm()
    {
        return view('auth.login', ['url' => 'customer']);
    }

    public function customerLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    return redirect()->route('customer.index')->with('success', 'Login successfully!');
                } else {
                    return redirect()->route('customer.login')->with('error', 'Invalid credentials');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Somethig went wrong', 'error_msg' => $e->getMessage()]);
        }
    }
}