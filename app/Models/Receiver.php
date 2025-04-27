<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
  
    protected $table = 'receive';
    protected $fillable = ['agent_supplier', 'agent_supplier_id', 'date','receive_from', 'remark', 'user', 'amount', 'previous_amount', 'current_amount', 'invoice', 'method'];
    
}
?>