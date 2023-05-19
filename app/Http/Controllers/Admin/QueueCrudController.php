<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QueueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\ReviseOperation\ReviseOperation;

/**
 * Class QueueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QueueCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use ReviseOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Queue::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/queue');
        CRUD::setEntityNameStrings('queue', 'queues');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('status');
        CRUD::column('number');

        $this->crud->addColumns([
            [
                'name' => 'counter',
                'type' => 'select',
                'label' => 'Counter',

                'entity' => 'counter',
                'model' => "App\Models\Counter",
                'attribute' => 'name',
            ],
            [
                'name' => 'visa_type',
                'type' => 'select',
                'label' => 'Visa Type',

                'entity' => 'visa_type',
                'model' => "App\Models\VisaType",
                'attribute' => 'full_name',
            ]
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(QueueRequest::class);

        $this->crud->addFields([
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'label' => 'Queue Status',
                'options' => get_queue_statuses()
            ],
            [
                'name' => 'number',
                'label' => 'Queue Number',
                'type' => 'text',
            ],
            [
                'name' => 'counter',
                'label' => 'Counter',
                'type' => 'select',
                'entity' => 'counter',
                'model' => 'App\Models\Counter',
                'attribute' => 'name',
            ],
            [
                'name' => 'visa_type',
                'label' => 'Visa Type',
                'type' => 'select',
                'entity' => 'visa_type',
                'model' => 'App\Models\VisaType',
                'attribute' => 'name',
            ]
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
