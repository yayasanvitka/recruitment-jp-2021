<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemTagsRequest;
use App\Models\Item;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemTagsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ItemTags::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item/itemTag');
        CRUD::setEntityNameStrings('item', 'items');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addFilters();

        $this->crud->addColumns([
            [
                'label' => 'Item',
                'name' => 'item_id',
                'type' => 'select_from_array',
                'options' => Item::pluck('name', 'id'),
            ],
            [
                'label' => 'Name',
                'name' => 'name',
            ],
        ]);
    }

    /**
     * Add filters.
     */
    private function addFilters()
    {
        $this->crud->addFilter([
            'name' => 'item',
            'type' => 'dropdown',
            'label' => 'Item',
        ], function () {
            return Item::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'item_id', $value);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ItemTagsRequest::class);

        $this->crud->addFields([
            [
                'label' => 'Item',
                'name' => 'item_id',
                'type' => 'select2_from_array',
                'options' => Item::orderBy('name', 'ASC')->pluck('name', 'id'),
                'allows_null' => true,
            ],
            [
                'label' => 'Name',
                'name' => 'name',
            ],
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
