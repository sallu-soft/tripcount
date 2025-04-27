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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;




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

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);

    }

    public function store_emp(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $userId = $request->user;
        
        // $emp = Employee::where('email', $email)
        //     ->where('name', 'like', '%' . $userId . '%')
        //     ->first();
        // $emp = User::where('email', $email)
        //             ->get();
       
        DB::enableQueryLog();

        // Execute the query
        $user = User::where('name', 'like', '%' . $userId . '%')->first();

        if($user){
            $userId = $user->id;
            $emp = Employee::where('email', $email)
            ->where('user', $userId)
            ->first();
        }
      
        $sql = DB::getQueryLog();

        // Dump the results and the SQL query log
        // dd($emp, md5($password));

    
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