<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experence extends Model
{
    use HasFactory;

    protected $table = 'experences';
    protected $guarded = ['id'];
    protected $fillable = [
        'employee_id',
        'title',
        'employment_type',
        'company_name',
        'start_date',
        'end_date',
        'location',
        'description',
        'created_by',
        'updated_by'
    ];
}
