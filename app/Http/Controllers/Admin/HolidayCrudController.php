<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HolidayRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class HolidayCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class HolidayCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Holiday::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/holiday');
        CRUD::setEntityNameStrings('holiday', 'holidays');
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
            'name'  => 'title',
            'type'  => 'text',
            'label' => 'Title'
        ]);
        $this->crud->addColumn([
            'name'  => 'month',
            'type'  => 'date',
            'label' => 'Month'
        ]);
        
        $this->crud->addColumn([
            'name'  => 'created_at',
            'type'  => 'date',
            'label' => 'Created At'
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

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(HolidayRequest::class);

        CRUD::field('title');
        CRUD::field('month');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */


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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
