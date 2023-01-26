<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTraining extends Model
{
    use HasFactory;
    protected $table = 'staff_trainings';
    protected $guarded = ['id'];
    protected $fillable = [
        'employee_id',
        'title',
        'start_date',
        'end_date',
        'updated_by'
    ];
}
