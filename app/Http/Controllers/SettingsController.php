<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Type;
use Illuminate\Support\Facades\Auth; // Add this line


class SettingsController extends Controller
{
    
    public function index()
    {
        if(Auth::user()){
            $user = Auth::id();
            return view('settings.change_password.index');
        }
        else{
            return view('welcome');
        }
        
    }
    public function change_password()
    {
        if(Auth::user()){
            $user = Auth::id();
            return view('settings.change_password.index');
        }
        else{
            return view('welcome');
        }
        
    }
    public function edit_company_profile()
    {
        if(Auth::user()){
            $user = Auth::id();
            return view('settings.company_profile.index');
        }
        else{
            return view('welcome');
        }
    
    }
   
}
