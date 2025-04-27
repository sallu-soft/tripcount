<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
  
    protected $table = 'expenditure';
    protected $fillable = ['name','description', 'user'];
    
}
?>