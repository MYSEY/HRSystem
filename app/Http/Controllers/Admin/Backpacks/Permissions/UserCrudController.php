<?php

namespace App\Http\Controllers\Admin\Backpacks\Permissions;

use App\Models\Department;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(config('backpack.permissionmanager.models.user'));
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
        $this->crud->setRoute(backpack_url('user'));
    }

    public function setupListOperation()
    {
        $this->crud->disableResponsiveTable();

        $this->crud->addFilter([
            'name'  => 'role',
            'type'  => 'dropdown',
            'label' => 'Role'
        ], 
        function(){
            return Role::pluck('name', 'id')->toArray();
        }, 
        function($value) { // if the filter is active
            $this->crud->addClause('where', 'name', $value);
        });
        $this->crud->addFilter([
            'name'  => 'department_id',
            'type'  => 'dropdown',
            'label' => 'Department'
        ], 
        function(){
            return Department::pluck('name', 'id')->toArray();
        }, 
        function($value) { // if the filter is active
            $this->crud->addClause('where', 'name', $value);
        });

        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        
        $this->crud->addColumn([
            'name'  => 'profile',
            'label' => 'Profile',
            'type'     => 'image',
            'prefix' => 'images/users/',
            // 'function' => function () {
            //     return '<img class="example-image" src="{{asset("images/users/default-user-icon.png")}}" alt="" width="35" style="cursor:pointer"/>';
            // }
        ]);
        $this->crud->addColumn([
            'name' => 'FullName',
            'label' => 'Name',
            'attribute' => 'name',
            'type' => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere($column['attribute'], 'like', '%' . $searchTerm . '%');
            }
        ]);
        $this->crud->addColumn([
            'name'  => 'phone',
            'label' => 'Phone',
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
            'name'  => 'email',
            'label' => 'Email',
            'type'  => 'email',
        ]);
        $this->crud->addColumn([
            'name'  => 'date_of_birth',
            'label' => 'Date Of Birth',
            'type'  => 'date',
        ]);
        $this->crud->addColumn([
            'name'  => 'position',
            'label' => 'Position',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'label'     => 'Roles', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'roles', // the method that defines the relationship in your Model
            'entity'    => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => config('permission.models.role'), // foreign key model
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
            'name'  => 'created_at',
            'label' => 'Created',
            'type'  => 'date',
        ]);
    }

    public function setupCreateOperation()
    {
        $this->addUserFields();
        $this->crud->setValidation(UserRequest::class);
    }

    public function setupUpdateOperation()
    {
        $this->addUserFields();
        $this->crud->setValidation(UpdateRequest::class);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }

    /**
     * Handle password input fields.
     */
    protected function handlePasswordInput($request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');
        $request->request->remove('roles_show');
        $request->request->remove('permissions_show');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        return $request;
    }

    protected function addUserFields()
    {
        $colMd6 = ['class' => 'form-group col-md-6 col-12' ]; 
        $tabOne = 'User Info';
        $tabTwo = 'User Roles';

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => 'First Name',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'last_name',
                'label' => 'Last Name',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'date_of_birth',
                'label' => 'Date Of Birth',
                'type'  => 'date',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'identity_type',
                'label' => 'Identity Type',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'identity_number',
                'label' => 'Identity Number',
                'type'  => 'number',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'issue_date',
                'label' => 'Issue Date',
                'type'  => 'date',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'house_no',
                'label' => 'House No',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'street_no',
                'label' => 'Street No',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'phone',
                'label' => 'Phone',
                'type'  => 'number',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'email',
                'label' => 'Email',
                'type'  => 'email',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'position',
                'label' => 'Position',
                'type'  => 'text',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'        => 'department_id',
                'label'       => "Department",
                'type'        => 'select2_from_array',
                'options'     => Department::get()->pluck('name', 'id')->toArray(),
                'allows_null' => false,
                'default'     => 'one',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'password',
                'label' => 'Password',
                'type'  => 'password',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'name'  => 'password_confirmation',
                'label' => 'Password Confirmation',
                'type'  => 'password',
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                'label' => "Profile",
                'name' => "profile",
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
                'disk'      => 's3_bucket', // in case you need to show images from a different disk
                'prefix'    => 'images/users/', // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
                'wrapperAttributes' => $colMd6,
                'tab'   =>  $tabOne
            ],
            [
                // two interconnected entities
                'label'             => trans('backpack::permissionmanager.user_role_permission'),
                'field_unique_name' => 'user_role_permission',
                'type'              => 'checklist_dependency',
                'name'              => ['roles', 'permissions'],
                'tab'               =>  $tabTwo,
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => 'name', // foreign key attribute that is shown to user
                        'model'            => config('permission.models.role'), // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => mb_ucfirst(trans('backpack::permissionmanager.permission_plural')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => 'name', // foreign key attribute that is shown to user
                        'model'          => config('permission.models.permission'), // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
            ],
        ]);
    }
}
