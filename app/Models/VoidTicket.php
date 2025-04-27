<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoidTicket extends Model
{
  
    protected $table = 'voidTicket';
    protected $fillable = ['prev_agent_amount', 'prev_supplier_amount', 'now_agent_fere', 'now_supplier_fere', 'ticket_no'];
    
}
?>