<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wakala extends Model
{
    use HasFactory;
    protected $table = 'wakala'; 

    protected $fillable = [
        'invoice',
        'date',
        'visa',
        'id_no',
        'agent',
        'agent_supplier',
        'supplier',
        'quantity',
        'buying_price',
        'multi_currency',
        'total_price',
        'country',
        'sales_by',
        'user',
        'created_at',
        'updated_at'
    ];

    // app/Models/Wakala.php
    public static function generateNextInvoiceNumber()
    {
        $latest = static::where('user', auth()->id())->latest()->first();
        return 'WAKL-' . str_pad(($latest->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);
    }
}