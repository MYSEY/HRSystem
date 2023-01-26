<table class="table table-striped">
    <tbody>
        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Personal Info</label>
            </td>
        </tr>

        <tr>
            <td class="border-0 font-weight-bold">Employee ID</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->number_employee ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Employee Name (KH)</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->employee_name_kh ?? '' }}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Employee Name (EN)</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->employee_name_en ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Date Of Birth</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ \Carbon\Carbon::parse($entry->date_of_birth)->format('d-M-Y')}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Gender</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->EmployeeGender ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Nationality</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->nationality ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Position</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->EmployeePosition ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Department</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->EmployeeDepartment ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Branch</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->EmployeeBrnach ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Unit</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->unit ?? '' }}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">level</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->level ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Date Of Commencement</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ \Carbon\Carbon::parse($entry->date_of_commencement)->format('d-M-Y')}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Guarantee Letter</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->guarantee_letter ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Employment Book</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->employment_book ?? ''}}
            </td>
        </tr>
        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Bank Info</label>
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Bank Name</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->bank_name ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Accout Name</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->account_name ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Bank Name</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->account_number ?? '' }}
            </td>
        </tr>

        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Contact Info</label>
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Company Phone</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->company_phone_number ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Personal Phone</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->personal_phone_number ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Agency Phone</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->agency_phone_number ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">email</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->email ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Telegram</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->telegram ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Messenger</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->messenger ?? ''}}
            </td>
        </tr>

        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Identities</label>
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Identity Type</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->EmployeeIdentityType ?? '' }}
            </td>
            <td class="border-0 font-weight-bold">Identity Number</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ $entry->identity_number ?? ''}}
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Issue Date</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ \Carbon\Carbon::parse($entry->issue_date)->format('d-M-Y')}}
            </td>
            <td class="border-0 font-weight-bold">Issue Expired Date</td>
            <td class="border-0">:</td>
            <td class="border-0">
                {{ \Carbon\Carbon::parse($entry->issue_expired_date)->format('d-M-Y')}}
            </td>
        </tr>

        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Current Address</label>
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Current Address</td>
            <td class="border-0">:</td>
            <td colspan="6" class="border-0">
                {{ $entry->FullAddressKh }}
            </td>
        </tr>

        <tr class="bg-white">
            <td colspan="6" class="p-0">
                <label class="custom-navbar-brand mb-0" style="font-weight: bolder; padding: 5px 10px;">Permanent Addtress</label>
            </td>
        </tr>
        <tr> 
            <td class="border-0 font-weight-bold">Permanent Addtress</td>
            <td class="border-0">:</td>
            <td colspan="6" class="border-0">
                {{ $entry->FullAddressEn }}
            </td>
        </tr>
    </tbody>
</table>
