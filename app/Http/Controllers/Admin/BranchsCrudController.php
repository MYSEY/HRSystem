<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BranchsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BranchsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BranchsCrudController extends CrudController
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
    public function setup()
    {
        CRUD::setModel(\App\Models\Branchs::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/branchs');
        CRUD::setEntityNameStrings('branchs', 'branchs');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        $this->crud->addColumn([
            'name'  => 'branch_name_kh',
            'type'  => 'text',
            'label' => 'Name Khmer'
        ]);
        $this->crud->addColumn([
            'name'  => 'branch_name_en',
            'type'  => 'text',
            'label' => 'Name English'
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
        $this->crud->addColumn(
            [
                'label' => 'Updated By',
                'name'  => 'updated_by',
                'type'     => 'closure',
                'function' => function ($entry) {
                    return optional($entry->upldatedBy)->FullName;
                }
            ],
        );

        $this->crud->addColumn([
            'name'  => 'created_at',
            'type'  => 'date',
            'label' => 'Created At'
        ]);
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
        return $this->traitStore();
    }



    public function update()
    {
        $this->crud->addField([
            'name' => 'updated_by',
            'type' => 'hidden'
        ]);
        request()->merge([
            'updated_by' => Auth::id()
        ]);
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
        CRUD::setValidation(BranchsRequest::class);

        $this->crud->addField([
            'name'  => 'branch_name_kh',
            'label' => 'Name Khmer',
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'branch_name_en',
            'label' => 'Name English',
            'type'  => 'text'
        ]);
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
