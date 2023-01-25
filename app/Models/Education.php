<?php

namespace App\Models;

use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    public function getEdcutionFieldOfStudyAttribute(){
        $data = Option::where('type','field_of_study')->get();
        foreach($data as $item){
            if($this->field_of_study == $item->id){
                $FieldOfStudy = $item->name_khmer;
            }
        }
        return $FieldOfStudy;
    }
    public function getEdcutiondegreeAttribute(){
        $data = Option::where('type','degree')->get();
        foreach($data as $item){
            if($this->degree == $item->id){
                $degree = $item->name_khmer;
            }
        }
        return $degree;
    }
}
