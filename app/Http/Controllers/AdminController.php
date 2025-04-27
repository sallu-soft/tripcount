<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\PendingUser;
use App\Models\User;
use App\Mail\UserApprovalMail;

class AdminController extends Controller
{
    protected $adminEmail = 'admin@example.com';  // Replace with your admin email
    protected $adminPassword = 'adminpassword';  // Replace with your admin password

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($request->email === $this->adminEmail && $request->password === $this->adminPassword) {
            // Auth::loginUsingId(1); // Assume admin user is the first user
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showPendingUsers()
    {
        $pendingUsers = PendingUser::all();
        return view('admin.pending_users', compact('pendingUsers'));
    }

    public function approveUser($id)
    {
        $pendingUser = PendingUser::findOrFail($id);

        $user = User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password,
            'mobile_no' => $pendingUser->mobile_no,
            'tel_no' => $pendingUser->tel_no,
            'company_address' => $pendingUser->company_address,
            'company_logo' => $pendingUser->company_logo,
            'is_approved' => true,
            'approval_token' => Str::random(60),
        ]);

        $pendingUser->is_approved = 1;
        $pendingUser->save();

        Mail::to($user->email)->send(new UserApprovalMail($user));

        return redirect()->route('admin.pending_users')->with('status', 'User approved successfully.');
    }

}
