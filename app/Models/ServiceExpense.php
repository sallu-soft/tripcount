<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_service_id',
        'user',
        'expense_title',
        'expense_amount',
    ];

    // Relationships
    public function service()
    {
        return $this->belongsTo(ContractService::class, 'contract_service_id');
    }
}
