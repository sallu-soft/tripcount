<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtraTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_service_id',
        'user',
        'agent_supplier',
        'supplier',
        'amount',
        'extratype',
    ];

    // Relationships
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

  
}
