<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  
    protected $table = 'order';
    protected $fillable = ['name', 'phone', 'user', 'agent', 'supplier', 'date', 'invoice', 'seller', 'passport_no', 'contact_amount', 'payable_amount', 'other_expense', 'country', 'remark'];
    
}
?>