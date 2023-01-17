<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OptionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Option::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/option');
        CRUD::setEntityNameStrings('option', 'options');
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
            'name'  => 'name_khmer',
            'type'  => 'text',
            'label' => 'Name Khmer'
        ]);
        $this->crud->addColumn([
            'name'  => 'name_english',
            'type'  => 'text',
            'label' => 'Name English'
        ]);
        $this->crud->addColumn([
            'name'  => 'type',
            'type'  => 'text',
            'label' => 'Type'
        ]);
        $this->crud->addColumn([
            'name'  => 'created_by',
            'type'  => 'text',
            'label' => 'Created By'
        ]);
        $this->crud->addColumn([
            'name'  => 'updated_by',
            'type'  => 'text',
            'label' => 'Updated By'
        ]);
        $this->crud->addColumn([
            'name'  => 'created_at',
            'type'  => 'text',
            'label' => 'Created At'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OptionRequest::class);

        $this->crud->addField([
            'name'  => 'name_khmer',
            'type'  => 'text',
            'label' => 'Name Khmer'
        ]);
        $this->crud->addField([
            'name'  => 'name_english',
            'type'  => 'text',
            'label' => 'Name English'
        ]);
        $this->crud->addField([
            'name'        => 'type',
            'label'       => "Type",
            'type'        => 'select2_from_array',
            'options'     => Option::get()->pluck('type', 'id')->toArray(),
            'allows_null' => false,
            'default'     => '1',
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
