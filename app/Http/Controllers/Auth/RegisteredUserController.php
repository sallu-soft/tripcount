<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\UserRegistrationRequestMail; // Add this line
use App\Models\PendingUser;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'mobile_no' => $request->mobile_no,
    //         'tel_no' => $request->tel_no,
    //         'company_address' => $request->company_address,
    //         'is_approved' => false,
    //         'approval_token' => Str::random(60),
    //     ]);
    //     // if ($request->hasFile('company_logo')) {
    //     //     $logoPath = $request->file('company_logo')->store('company_logos', 'public');
    //     //     $user->company_logo = $logoPath;
    //     // }
    //     if ($request->hasFile('company_logo')) {
    //         $logo = $request->file('company_logo');
    //         $logo->move(public_path('company_logo'), $logo->getClientOriginalName());
    //         $user->company_logo = 'company_logo/' . $logo->getClientOriginalName();
    //     }
    //     $user->save();
    //     Mail::to($user->email)->send(new UserRegistrationRequestMail($user));
        
    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:pending_users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pendingUser = PendingUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_no' => $request->mobile_no,
            'tel_no' => $request->tel_no,
            'company_address' => $request->company_address,
        ]);

        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $logo->move(public_path('company_logo'), $logo->getClientOriginalName());
            $company_logo = 'company_logo/' . $logo->getClientOriginalName();
            // dd($company_logo);
            $pendingUser->company_logo = $company_logo;
        }

        $pendingUser->save();
        
        // Mail::to($pendingUser->email)->send(new UserRegistrationRequestMail($pendingUser));
        // event(new Registered($pendingUser));
        return redirect()->back()->with('status', 'Registration submitted for approval.');
    }
}
