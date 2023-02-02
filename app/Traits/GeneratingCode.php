<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Employee;

trait GeneratingCode
{
   
    //*** Generate employee
    public function generate_EmployeeId($date)
    {
        $count = 0;
        $employeeDate = Carbon::parse($date);
        $lastInId = Employee::whereYear('created_by', $employeeDate->format('y'))->orderBy('number_employee', 'asc')->get();
        if (!empty($lastInId)) {
            for ($i = 0; $i < count($lastInId); $i++) {
                $current = (int) substr(strrchr($lastInId[$i]->number_employee, "-"), 1);
                if ($i + 1 < count($lastInId)) {
                    $next = (int) substr(strrchr($lastInId[$i + 1]->number_employee, "-"), 1);
                }
                if (isset($next) && $current + 1 != $next) {
                    $count = (int) substr(strrchr($lastInId[$i]->number_employee, "-"), 1);
                    break;
                } else {
                    $count = (int) substr(strrchr($lastInId[$i]->number_employee, "-"), 1);
                }
            }
        }

        do {
            $eployeeId =  $employeeDate->format('y').'0' . '-' . str_pad(($count + 1), 4, "0", STR_PAD_LEFT);
            $alreadyExist = Employee::select('number_employee')->where('number_employee', $eployeeId)->first()->number_employee ?? null;
            $count++;
        } while ($alreadyExist);
        return [
            'number_employee' => $eployeeId
        ];
    }
}
