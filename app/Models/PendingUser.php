<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    protected $table = 'pending_users';
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'tel_no',
        'company_address',
        'company_logo',
        'is_approved',
        'approval_token',
    ];
}
