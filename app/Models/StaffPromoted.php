<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffPromoted extends Model
{
    use HasFactory;
    use SoftDeletes;

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
