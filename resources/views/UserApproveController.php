<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ApprovalMail;
use App\Mail\DenyMail;
use Illuminate\Support\Facades\Mail;

class UserApprovalController extends Controller
{
    public function approve($id)
    {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();

        Mail::to($user->email)->send(new ApprovalMail($user));

        return redirect()->back()->with('status', 'User approved and notified.');
    }

    public function deny($id)
    {
        $user = User::find($id);
        $user->delete();

        Mail::to($user->email)->send(new DenyMail($user));

        return redirect()->back()->with('status', 'User denied and notified.');
    }
}
