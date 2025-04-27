<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserApprovalMail;
use App\Mail\UserDenyMail;
use Illuminate\Support\Facades\Mail;

class UserApprovalController extends Controller
{
    public function approve($id)
    {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();

        Mail::to($user->email)->send(new UserApprovalMail($user));

        return redirect()->back()->with('status', 'User approved and notified.');
    }

    public function deny($id)
    {
        $user = User::find($id);
        $user->delete();

        Mail::to($user->email)->send(new UserDenyMail($user));

        return redirect()->back()->with('status', 'User denied and notified.');
    }
}
