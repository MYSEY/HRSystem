<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    protected $guarded = ['id'];
    protected $fillable = [
        'employee_id',
        'school',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
        'description',
        'created_by',
        'updated_by'
    ];
}
