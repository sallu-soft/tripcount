<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function create_emp(): View
    {
        $users = User::all();
        // dd($users);
        return view('auth.emp_login', compact('users'));
    }

    
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    //     return redirect()->intended(RouteServiceProvider::HOME);

    // }
    public function store(LoginRequest $request): RedirectResponse
    {
        // Get the user trying to log in
        $user = User::where('email', $request->email)->first();
    
        // Check if the user exists
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'These credentials do not match our records.']);
        }
    
        // Check the difference between prev_month and today's date
        $prevMonth = \Carbon\Carbon::parse($user->prev_month);
        $today = \Carbon\Carbon::now();
        $diffInDays = $today->diffInDays($prevMonth);
        // dd($diffInDays);
        if ($diffInDays >= 30) {
            session(['user_id' => $user->id]);
            // $user = User::find($)
            $user->is_paid = 0;
            $user->save();
            // Redirect to the payment index route if the difference is 30 days or more
            return redirect()->route('payment.index')->withErrors(['message' => 'Your account has been inactive for more than 30 days.']);
        }
    
        // Authenticate and regenerate session if the difference is less than 30 days
        $request->authenticate();
        $request->session()->regenerate();
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    


    public function store_emp(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $password = $request->password;
        $userId = User::where('name', 'LIKE', $request->company)->value('id'); 
    
        // Retrieve the user by email
        $emp = Employee::where([
            ['email', $email],
            ['user', $userId]
        ])->first();


        // dd(md5($password), $emp, $userId);
        // Check if the user exists and the password is correct
        if ($emp) {
            // Check if the user ID matches
            if ( md5($password) == $emp->password) {
                // dd('match');
                $user = User::find($userId);
                Session::put('employee', $emp);
                Auth::login($user);
    
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                // User ID does not match
                // dd('cot');
                return redirect()->back()->with('error', 'Invalid user.');
            }
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}