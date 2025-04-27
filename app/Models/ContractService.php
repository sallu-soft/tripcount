<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractService extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'user',
        'service_type',
        'allocated_amount',
    ];

    // Relationships
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

  
}
