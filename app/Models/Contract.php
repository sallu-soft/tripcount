<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'user',
        'total_amount',
        'contract_date',
        'notes',
    ];

    // Relationships
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function services()
    {
        return $this->hasMany(ContractService::class);
    }

    // Total expense of this contract (sum of all services' expenses)
    public function totalExpense()
    {
        return $this->services->sum(function ($service) {
            return $service->expenses->sum('expense_amount');
        });
    }

    // Profit = Total amount - total expenses
    public function profit()
    {
        return $this->total_amount - $this->totalExpense();
    }
}
