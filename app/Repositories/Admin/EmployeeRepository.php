<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\Education;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFiles\UploadFIle;

/**
 * Class BankRepository
 * @package App\Repositories\V1\Bank
 * @version July 20, 2020, 3:07 am UTC
 */

class EmployeeRepository extends BaseRepository
{
    use UploadFIle;
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Employee::class;
    }
    public function updateOrCreateEducation($entry, $request)
    {
        try {
            Education::where('employee_id', $entry->id)->delete();
            $schools = $request->school;
            if (is_array($schools)) {
                foreach($schools as $key=>$item){
                    Education::updateOrCreate([
                        'employee_id'       => $entry->id,
                    ],[
                        'employee_id'       => $entry->id,
                        'school'            => $item ?? '',
                        'field_of_study'    => $request->field_of_study[$key] ?? '',
                        'degree'            => $request->degree[$key] ?? '',
                        'grade'             => $request->grade[$key] ?? '',
                        'description'       => $request->education_description[$key] ?? '',
                        'end_date'          => !empty($request->education_end_date[$key]) ? Carbon::parse($request->education_end_date[$key])->format('Y-m-d') : '',
                        'start_date'        => !empty($request->education_start_date[$key]) ? Carbon::parse($request->education_start_date[$key])->format('Y-m-d') : '',
                        'updated_by'        => Auth::id()
                    ]);
                }
            }
        } catch (\Exception $exp) {
            /*
            * ERROR
            */
        }
    }
}
