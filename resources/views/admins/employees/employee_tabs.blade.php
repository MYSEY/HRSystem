<div class="col-md-12">
    <ul class="nav nav-tabs" id="employeeTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="employee-tab" data-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="true">Employee Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Educations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experiences</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#training" role="tab" aria-controls="training" aria-selected="false">Trainings</a>
        </li>
    </ul>
    <div class="tab-content" id="employeeContent" table-responsive>
        <div class="tab-pane fade show active" id="employee" role="tabpanel">
            @component('admins.employees.employee_info', compact('entry'))
            @endcomponent
        </div>
        <div class="tab-pane fade show" id="education" role="tabpanel">
            @component('admins.employees.education', compact('entry'))
            @endcomponent
        </div>
        <div class="tab-pane fade show" id="experience" role="tabpanel">
            @component('admins.employees.experience', compact('entry'))
            @endcomponent
        </div>
        <div class="tab-pane fade show" id="training" role="tabpanel">
            @component('admins.employees.training', compact('entry'))
            @endcomponent
        </div>
    </div>
</div>