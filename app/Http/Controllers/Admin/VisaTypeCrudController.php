<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VisaTypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class VisaTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VisaTypeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\VisaType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/visa-type');
        CRUD::setEntityNameStrings('visa type', 'visa types');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => 'Visa Type',
                'type' => 'text',
            ],
            [
                'name' => 'code',
                'label' => 'Visa Type Code',
                'type' => 'text',
            ],
            [
                'name' => 'starting_number',
                'label' => 'Starting Number',
                'type' => 'text',
            ],
            [
                'name' => 'counters',
                'label' => 'Counters',
                'type' => 'relationship_count',
                'suffix' => ' Counters',
            ]
        ]);
        CRUD::column('status');

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
        CRUD::setValidation(VisaTypeRequest::class);

        $this->crud->addFields(
            [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Name',
                    'attributes' => [
                        'placeholder' => 'Name',
                    ],
                ],
                [
                    'name' => 'slug',
                    'type' => 'slug',
                    'label' => 'Slug',
                    'target' => 'name',
                    'attributes' => [
                        'readonly' => 'readonly',
                    ]
                ],
                [
                    'name' => 'code',
                    'type' => 'text',
                    'label' => 'Code',
                    'attributes' => [
                        'placeholder' => 'Code',
                    ],
                ],
                [
                    'name' => 'starting_number',
                    'type' => 'number',
                    'label' => 'Starting Number',
                    'attributes' => [
                        'placeholder' => 'Starting Number',
                    ],
                ],
                [
                    'label' => 'Counters',
                    'name' => 'counters',
                    'type' => 'select2_multiple',
                    'entity' => 'counters',
                    'attribute' => 'name',
                ],
                [
                    'name' => 'status',
                    'type' => 'toggle',
                    'label' => 'Status',
                    'view_namespace' => 'toggle-field-for-backpack::fields',
                ],
            ]
        );

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
