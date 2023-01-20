<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Branchs;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
use App\Models\Option;
use App\Models\Position;
use App\Repositories\Admin\EmployeeRepository;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */

    public $startLabel = '<label class="navbar-brand custom-navbar-brand mb-0">';
    public $endLabel = '</label>';
    protected $employeeRepo;
    public function setup()
    {
        CRUD::setModel(\App\Models\Employee::class);
        $this->employeeRepo = resolve(EmployeeRepository::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('employee', 'employees');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->disableResponsiveTable();

        $this->crud->addFilter([
            'name'  => 'employee_name_en',
            'type'  => 'select2',
            'label' => 'Employee Name'
        ], 
        function(){
            return Employee::pluck('employee_name_en', 'employee_name_en')->toArray();
        }, 
        function($value) { // if the filter is active
            $this->crud->addClause('where', 'employee_name_en', $value);
        });

        $this->crud->addFilter([
            'name'  => 'department_id',
            'type'  => 'select2',
            'label' => 'Department'
        ], 
        function(){
            return Department::pluck('name', 'id')->toArray();
        }, 
        function($value) { // if the filter is active
            $this->crud->addClause('where', 'department_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'position_id',
            'type'  => 'select2',
            'label' => 'Position'
        ],
        function(){
            return Employee::pluck('position_id', 'position_id')->toArray();
        }, 
        function($value) { // if the filter is active
            $this->crud->addClause('where', 'position_id', $value);
        });

        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();

        $this->crud->addColumn([
            'name'  => 'profile',
            'label' => 'profile',
            'type'     => 'closure',
            'function' => function ($entry) {
                if (Helper::isUrl($entry->profile)) {
                    return '<a class="example-image-link" href="' . $entry->profile . '" data-lightbox="lightbox-' . $entry->id . '"><img class="example-image" src="' . $entry->profile .'" alt="" width="35" style="cursor:pointer"/></a>';
                } else {
                    return '<a class="example-image-link" href="' . $entry->MediumProfile . '" data-lightbox="lightbox-' . $entry->id . '"><img class="example-image" src="' . $entry->MediumProfile .'" alt="" width="35" style="cursor:pointer"/></a>';
                }
            }
        ]);
        $this->crud->addColumn([
            'name'  => 'number_employee',
            'type'  => 'text',
            'label' => 'Employee ID'
        ]);
        $this->crud->addColumn([
            'name'  => 'employee_name_en',
            'type'  => 'text',
            'label' => 'Employee Name (EN)'
        ]);
        $this->crud->addColumn([
            'name'  => 'employee_name_kh',
            'type'  => 'text',
            'label' => 'Employee Name (KH)'
        ]);
        // $this->crud->addColumn([
        //     'name'  => 'position',
        //     'type'  => 'dete',
        //     'label' => 'Position'
        // ]);
        $this->crud->addColumn([
            'name'  => 'position_id',
            'label' => 'Position',
            'type'  => 'closure',
            'attribute' => 'name_khmer',
            'function' => function ($entry) {
                return optional($entry->position)->name_khmer;
            },
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('position', function ($q) use ($column, $searchTerm) {
                    $q->where($column['attribute'], 'like', '%' . $searchTerm . '%')
                    ->orWhere('name_khmer', 'like', '%' . $searchTerm . '%');
                });
            }
        ]);
        $this->crud->addColumn([
            'name'  => 'department',
            'label' => 'Department',
            'type'  => 'closure',
            'attribute' => 'name',
            'function' => function ($entry) {
                return optional($entry->department)->name;
            },
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('department', function ($q) use ($column, $searchTerm) {
                    $q->where($column['attribute'], 'like', '%' . $searchTerm . '%')
                        ->orWhere('name', 'like', '%' . $searchTerm . '%');
                });
            }
        ]);
        
        $this->crud->addColumn([
            'name'  => 'branch_id',
            'label' => 'Branch',
            'type'  => 'closure',
            'attribute' => 'branch_name_kh',
            'function' => function ($entry) {
                return optional($entry->branch)->branch_name_kh;
            },
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('branch', function ($q) use ($column, $searchTerm) {
                    $q->where($column['attribute'], 'like', '%' . $searchTerm . '%')
                        ->orWhere('branch_name_kh', 'like', '%' . $searchTerm . '%');
                });
            }
        ]);
        $this->crud->addColumn([
            'name'  => 'email',
            'type'  => 'email',
            'label' => 'Email'
        ]);
        $this->crud->addColumn([
            'name'  => 'company_phone_number',
            'type'  => 'text',
            'label' => 'Company Phone'
        ]);
        $this->crud->addColumn([
            'name'  => 'personal_phone_number',
            'type'  => 'text',
            'label' => 'Personal Phone'
        ]);
        
        $this->crud->addColumn([
            'name'  => 'created_at',
            'label' => 'Created At',
            'type'  => 'date',
        ]);
        
        $this->crud->addColumn(
            [
                'label' => 'Created By',
                'name'  => 'created_by',
                'type'     => 'closure',
                'attribute' => 'name',
                'function' => function ($entry) {
                    return optional($entry->createdBy)->FullName;
                },
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('createdBy', function ($q) use ($column, $searchTerm) {
                        $q->where($column['attribute'], 'like', '%' . $searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $searchTerm . '%');
                    });
                }
            ],
        );
        $this->crud->addColumn(
            [
                'label' => 'Updated By',
                'name'  => 'updated_by',
                'type'     => 'closure',
                'attribute' => 'name',
                'function' => function ($entry) {
                    return optional($entry->upldatedBy)->FullName;
                },
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('upldatedBy', function ($q) use ($column, $searchTerm) {
                        $q->where($column['attribute'], 'like', '%' . $searchTerm . '%')
                        ->orWhere('name', 'like', '%' . $searchTerm . '%');
                    });
                }
            ],
        );
    }


    public function store()
    {
        $this->crud->addField([
            'name' => 'created_by',
            'type' => 'hidden'
        ]);
        request()->merge([
            'created_by' => Auth::id()
        ]);

        $entry = $this->crud->entry;
        $this->employeeRepo->updateOrCreateEducation($entry, $this->crud->getRequest());
        $this->employeeRepo->updateOrCreateExperience($entry, $this->crud->getRequest());
        return $this->traitStore();
    }

    public function update($id)
    {
        $this->crud->addField([
            'name' => 'updated_by',
            'type' => 'hidden'
        ]);
        request()->merge([
            'updated_by' => Auth::id()
        ]);
        $entry = $this->crud->getEntry($id);
        $this->employeeRepo->updateOrCreateEducation($entry, $this->crud->getRequest());
        $this->employeeRepo->updateOrCreateExperience($entry, $this->crud->getRequest());
        return $this->traitUpdate();
    }
    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);
        $colMd6 = ['class' => 'form-group col-md-6 col-12' ]; 
        $colMd12 = ['class' => 'form-group col-md-12 col-12'];

        $tabOne = 'Employee Info';
        $tabTwo = "Education";
        $tabThree = "Experience";


        $this->crud->addField([
            'name'  => 'number_employee',
            'label' => 'Employee ID',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'employee_name_kh',
            'label' => 'Employee Name (KH)',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'employee_name_en',
            'label' => 'Employee Name (EN)',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'gender',
            'label' => 'Gender',
            'type'        => 'select2_from_array',
            'options'     => Option::where('type','gender')->get()->pluck('name_khmer', 'id')->toArray(),
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'date_of_birth',
            'label' => 'Date Of Birth',
            'type'  => 'date',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'        => 'nationality',
            'label'       => "Nationality",
            'type'        => 'select2_from_array',
            'options'     => ['khmer' => 'Khmer', 'chinese' => 'Chinese'],
            'allows_null' => false,
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        
        $this->crud->addField([
            'name'        => 'branch_id',
            'label'       => "Branch",
            'type'        => 'select2_from_array',
            'options'     => Branchs::get()->pluck('branch_name_kh', 'id')->toArray(),
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        $this->crud->addField([
            'name'  => 'unit',
            'label' => 'Unit',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'position_id',
            'label' => 'Position',
            'type'        => 'select2_from_array',
            'options'     => Position::get()->pluck('name_khmer', 'id')->toArray(),
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'        => 'department_id',
            'label'       => "Department",
            'type'        => 'select2_from_array',
            'options'     => Department::get()->pluck('name', 'id')->toArray(),
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'level',
            'label' => 'Level',
            'type'  => 'number',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'date_of_commencement',
            'label' => 'Date Of Commencement',
            'type'  => 'date',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        $this->crud->addField([
            'label' => 'Guarantee Letter',
            'type' => "upload",
            'name' => 'guarantee_letter',
            'upload' => true,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);
        $this->crud->addField([
            'label' => 'Employment Book',
            'type' => "upload",
            'name' => 'employment_book',
            'upload' => true,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);

        $this->crud->addField([
            'name'  => 'fixed_dura_con_type',
            'label' => 'Duration Type',
            'type'        => 'select2_from_array',
            'options'     => ['1' => 'FDC', '2' => 'UDC'],
            'allows_null' => false,
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        // Contact Info
        $this->crud->addField([
            'name' => 'Contact Info',
            'type' => 'custom_html',
            'value' => $this->startLabel .'Contact Info'. $this->endLabel,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd12,
        ]);
        $this->crud->addField([
            'name'  => 'personal_phone_number',
            'label' => 'Personal Phone',
            'type'  => 'phone',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'company_phone_number',
            'label' => 'Company Phone',
            'type'  => 'phone',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'agency_phone_number',
            'label' => 'Agency Phone',
            'type'  => 'phone',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'email',
            'label' => 'Email',
            'type'  => 'email',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'telegram',
            'label' => 'Telegram',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'messenger',
            'label' => 'Messenger',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        // Identities
        $this->crud->addField([
            'name' => 'Identity',
            'type' => 'custom_html',
            'value' => $this->startLabel .'Identities'. $this->endLabel,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd12,
        ]);
        $this->crud->addField([
            'name'    => 'identity_type',
            'label'   => 'Identity Type',
            'type'        => 'select2_from_array',
            'options'     => Option::where('type','identity_type')->get()->pluck('name_khmer', 'id')->toArray(),
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        
        $this->crud->addField([
            'label' => 'Identity Number',
            'type' => "number",
            'name' => 'identity_number',
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);
        $this->crud->addField([
            'label' => 'Issue Date',
            'type' => "date",
            'name' => 'issue_date',
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);
        $this->crud->addField([
            'label' => 'Issue Expired Date',
            'type' => "date",
            'name' => 'issue_expired_date',
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);

        // Current Address
        $this->crud->addField([
            'name' => 'Current Address',
            'type' => 'custom_html',
            'value' => $this->startLabel .'Current Address'. $this->endLabel,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd12,
        ]);

        $this->crud->addField([
            'name' => 'current_addtress',
            'label' => 'Current Address',
            'type' => 'flexiaddress',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'current_house_no',
            'label' => 'House No',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'current_street_no',
            'label' => 'Street No',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        // Permanent Address
         $this->crud->addField([
            'name' => 'Permanent Addtress',
            'type' => 'custom_html',
            'value' => $this->startLabel .'Permanent Addtress'. $this->endLabel,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd12,
        ]);
        $this->crud->addField([
            'name' => 'permanent_addtress',
            'label' => 'Permanent Addtress',
            'type' => 'flexiaddress',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'permanent_house_no',
            'label' => 'House No',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'permanent_street_no',
            'label' => 'Street No',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        // Profile
        $this->crud->addField([
            'name' => 'Profile',
            'type' => 'custom_html',
            'value' => $this->startLabel .'Profile'. $this->endLabel,
            'tab' => $tabOne,
            'wrapperAttributes' => $colMd12,
        ]);
        $this->crud->addField([
            'label' => 'Profile',
            'name' => "profile",
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
            'default' => config('const.filePath.default_user'),
            'tab'   =>  $tabOne,
            'wrapperAttributes' => $colMd6,
        ]);

        // employee education
        $this->crud->addField([
            'label' => '',
            'name' => '',
            'type' => 'employee.education',
            'tab' => $tabTwo,
        ]);

        // employee experience
        $this->crud->addField([
            'label' => 'experience',
            'name' => 'experience',
            'type' => 'employee.experience',
            'tab' => $tabThree,
        ]);

        // CRUD::field('profile');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
