<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureMain extends Model
{
  
    protected $table = 'expenditure_main';
    protected $fillable = ['company_name','date', 'user', 'receive_from', 'from_account', 'toward', 'amount', 'method'];
    
}
?>