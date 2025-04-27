<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  
    protected $table = 'tickets';
    protected $fillable = ['flight_date', 'invoice_date','return','person', 'class','class_code', 'invoice', 'supplier', 'agent', 'agent_price', 'supplier_price', 'user', 'ticket_no', 'passenger', 'remark', 'stuff', 'flight_no', 'sector', 'discount'];
    
}
?>