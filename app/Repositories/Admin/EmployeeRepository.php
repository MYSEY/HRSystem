<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Employee;
use App\Models\Education;
use App\Models\Experience;
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
            if (is_array($schools) && count($schools)) {
                foreach ($schools as $key => $school) :
                    if (!empty($school)) :
                        Education::updateOrCreate([
                            'employee_id' => $entry->id,
                        ],[
                            'employee_id' => $entry->id,
                            'school' => $school ?? '',
                            'field_of_study' => $request->field_of_study[$key] ?? '',
                            'degree' => $request->degree[$key] ?? '',
                            'grade' => $request->grade[$key] ?? '',
                            'description' => $request->education_description[$key] ?? '',
                            'end_date' => !empty($request->education_end_date[$key]) ? Carbon::parse($request->education_end_date[$key])->format('Y-m-d') : '',
                            'start_date' => !empty($request->education_start_date[$key]) ? Carbon::parse($request->education_start_date[$key])->format('Y-m-d') : '',
                            'updated_by' => Auth::id(),
                        ]);
                    endif;
                endforeach;
            }
        } catch (\Exception $exp) {
            /*
            * ERROR
            */
        }
    }
    
    public function updateOrCreateExperience($entry, $request)
    {
        try {
            Experience::where('employee_id', $entry->id)->delete();
            $titles = $request->title;
            if (is_array($titles) && count($titles)) {
                foreach ($titles as $key => $title) :
                    if (!empty($title)) :
                        Experience::updateOrCreate([
                            'employee_id' => $entry->id,
                            'title' => $title ?? '',
                            'employment_type' => $request->employment_type[$key] ?? '',
                            'company_name' => $request->company_name[$key] ?? '',
                            'location' => $request->location[$key] ?? '',
                            'description' => $request->description[$key] ?? '',
                            'start_date' => !empty($request->start_date[$key]) ? Carbon::parse($request->start_date[$key])->format('Y-m-d') : '',
                            'end_date' => !empty($request->end_date[$key]) ? Carbon::parse($request->end_date[$key])->format('Y-m-d') : '',
                            'updated_by' => Auth::id(),
                        ]);
                    endif;
                endforeach;
            }
        } catch (\Exception $exp) {
            /*
            * ERROR
            */
        }
    }

    public function bankRepoUpdateOrCreate($entry, $request){
        try {
            Bank::where('employee_id', $entry->id)->delete();
            $data = $request->bank_name;
            if (is_array($data) && count($data)) {
                foreach ($data as $key => $item) :
                    if (!empty($item)) :
                        Bank::updateOrCreate([
                            'employee_id' => $entry->id,
                        ],[
                            'employee_id' => $entry->id,
                            'bank_name' => $request->bank_name[$key] ?? '',
                            'account_name' => $request->account_name[$key] ?? '',
                            'account_number' => $request->account_number[$key] ?? '',
                            'updated_by' => Auth::id(),
                        ]);
                    endif;
                endforeach;
            }
        } catch (\Exception $exp) {
            /*
            * ERROR
            */
        }
    }
}
