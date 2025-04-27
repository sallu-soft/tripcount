<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIT extends Model
{
  
    protected $table = 'ait';
    protected $fillable = ['ait_amount', 'ticket_invoice', 'sector','airline_name', 'user', 'total_amount', 'user'];
    
}
?>