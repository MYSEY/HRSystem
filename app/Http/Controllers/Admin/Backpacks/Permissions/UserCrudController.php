<?php

namespace App\Http\Controllers\Admin\Backpacks\Permissions;

use App\Helpers\Helper;
use App\Models\Department;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdated;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;



    public function setup()
    {
        $this->crud->setModel(config('backpack.permissionmanager.models.user'));
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
        $this->crud->setRoute(backpack_url('user'));
    }

    public function setupListOperation()
    {
        $this->crud->disableResponsiveTable();

        // Role Filter
        $arr = config('permission.models.role')::all();
        $roles = [];
        foreach ($arr as $ar) {
            $roles[$ar->id] = $ar->name;
        }
        $this->crud->addFilter(
            [
                'name'  => 'role',
                'type'  => 'select2',
                'label' => 'Roles',
            ],
            $roles,
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'roles', function ($query) use ($value) {
                    $query->where('role_id', '=', $value);
                });
            }
        );

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
            'label' => 'Created At',
            'type'  => 'date',
        ]);
        $this->crud->addColumn(
            [
                'label' => 'Created By',
                'name'  => 'created_by',
                'type'     => 'closure',
                'function' => function ($entry) {
                    return optional($entry->createdBy)->FullName;
                }
            ],
        );
        $this->crud->addColumn([
            'name'  => 'active',
            'label' => 'activate',
            'type' => 'view',
            'view' => 'columns.switch_button'
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
        $this->crud->setValidation(UserUpdated::class);
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
        $this->crud->addField([
            'name' => 'updated_by',
            'type' => 'hidden'
        ]);
        request()->merge([
            'updated_by' => Auth::id()
        ]);
        return $this->traitUpdate();
    }

    public function show($id)
    {
        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = trans('backpack::crud.preview') . ' ' . $this->crud->entity_name;

        return view('backpack.user.show', $this->data);
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

    public function fetchToggle()
    {
        $user = $this->crud->model->find(request()->id);
        $user->toggleActive()->save();
        return response()->json([
            'message' => true
        ]);
    }

    protected function addUserFields()
    {
        $colMd6 = ['class' => 'form-group col-md-6 col-12']; 
        $tabOne = 'User Info';
        $tabTwo = 'User Roles';
        $edit = $this->crud->actionIs('edit') ? "" : "";
        $this->crud->addField([
            'name'  => 'name',
            'label' => 'First Name',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'last_name',
            'label' => 'Last Name',
            'type'  => 'text',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'phone',
            'label' => 'Phone',
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
            'name'  => 'date_of_birth',
            'label' => 'Date Of Birth',
            'type'  => 'date',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'position_id',
            'label' => 'Position',
            'type'        => 'select2_from_array',
            'options'     => Position::get()->pluck('name_khmer', 'id')->toArray(),
            'allows_null' => false,
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'        => 'department_id',
            'label'       => "Department",
            'type'        => 'select2_from_array',
            'options'     => Department::get()->pluck('name', 'id')->toArray(),
            'allows_null' => false,
            'default'     => 'one',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'password',
            'label' => 'Password',
            'type'  => 'password',
            'value' => $edit,
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);
        $this->crud->addField([
            'name'  => 'password_confirmation',
            'label' => 'Password Confirmation',
            'type'  => 'password',
            'wrapperAttributes' => $colMd6,
            'tab'   =>  $tabOne
        ]);

        $this->crud->addField([
            'label' => 'Profile',
            'name' => "profile",
            'type' => 'upload',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 0,
            'default' => config('const.filePath.default_user'),
            'tab'   =>  $tabOne,
            'wrapperAttributes' => ['class' => 'form-group col-md-12 col-12'],
        ]);
        
        $this->crud->addField([
            'name' => 'created_by',
            'type' => 'hidden',
            'default' => Auth::id()
        ]);
        $this->crud->addFields([
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
