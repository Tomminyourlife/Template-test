<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Customer Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating customers for the application.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect customers after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * Show the customer login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.customerlogin');
    }

    /**
     * Validate the customer login request.
     *
     * @param  Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'string',
        ]);
    }

    /**
     * Attempt to log the customer into the application.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request){
        $credentials = $request->only('email');
    
        // Verifica se l'email è stata fornita
        if (!isset($credentials['email'])) {
            return back()->withErrors(['email' => 'Email field is required']);
        }

        $useremail = CustomerEmail::where('email', $credentials['email'])->first();
        if ($useremail) {
            $user = Customer::find($useremail->customer_id);
            if ($user) {
                Auth::login($useremail);
                $request->session()->put('customer', $user);
                return redirect()->intended('/customer/dashboard');
            }
        }
    
        return back()->withErrors(['email' => 'Invalid email']);
    }

    public function dashboard(){
        $message = "Sei nella tua dashboard! Clicca <a href='" . route('ticketing.index') . "'>qui</a> per vedere i tuoi ticket.";
        return view('dashboard', compact('message'));
    }

    /**
     * Log the customer out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}

