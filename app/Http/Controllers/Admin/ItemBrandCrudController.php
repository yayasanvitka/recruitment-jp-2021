<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemBrandRequest;
use App\Models\ItemGroup;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemBrandCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemBrandCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ItemBrand::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item/brand');
        CRUD::setEntityNameStrings('item brand', 'item brands');
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
                'label' => 'Group',
                'name' => 'group_id',
                'type' => 'select_from_array',
                'options' => ItemGroup::pluck('name', 'id'),
            ],
            [
                'label' => 'Code',
                'name' => 'code',
            ],
            [
                'label' => 'Name',
                'name' => 'name',
            ],
            [
                'name' => 'items',
                'type' => 'relationship_count',
                'label' => 'Items',
                'wrapper' => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('item/item?brand='.$entry->getKey());
                    },
                ],
            ],
        ]);
    }

    /**
     * Add filters.
     */
    private function addFilters()
    {
        $this->crud->addFilter([
            'name' => 'group',
            'type' => 'dropdown',
            'label' => 'Group',
        ], function () {
            return ItemGroup::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'group_id', $value);
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
        CRUD::setValidation(ItemBrandRequest::class);

        $this->crud->addFields([
            [
                'label' => 'Group',
                'name' => 'group_id',
                'type' => 'select2_from_array',
                'options' => ItemGroup::orderBy('name', 'ASC')->pluck('name', 'id'),
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
