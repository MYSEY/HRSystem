<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPromoted extends Model
{
    use HasFactory;
    protected $table = 'staff_promoteds';
    protected $guarded = ['id'];
    protected $fillable = [
        'employee_id',
        'posit_id',
        'depart_id',
        'created_by',
        'updated_by'
    ];
}
