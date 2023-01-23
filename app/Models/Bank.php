<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $guarded = ['id'];
    protected $fillable = [
        'employee_id',
        'bank_name',
        'account_name',
        'account_number',
        'updated_by'
    ];
}
