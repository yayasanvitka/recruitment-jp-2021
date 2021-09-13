<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use App\Models\ItemBrand;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Item::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item/item');
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
                'label' => 'Brand',
                'name' => 'brand_id',
                'type' => 'select_from_array',
                'options' => ItemBrand::pluck('name', 'id'),
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->leftJoin('item_brands', 'items.brand_id', '=', 'item_brands.id')
                        ->orderBy('item_brands.name', $columnDirection)->select('items.*');
                }
            ],
            [
                'label' => 'Code',
                'name' => 'code',
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
            'name' => 'brand',
            'type' => 'dropdown',
            'label' => 'Brand',
        ], function () {
            return ItemBrand::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'brand_id', $value);
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
        CRUD::setValidation(ItemRequest::class);

        $this->crud->addFields([
            [
                'label' => 'Brand',
                'name' => 'brand_id',
                'type' => 'select2_from_array',
                'options' => ItemBrand::orderBy('name', 'ASC')->pluck('name', 'id'),
                'allows_null' => true,
            ],
            [
                'label' => 'Code',
                'name' => 'code',
                'hint' => 'The code must be unique',
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
