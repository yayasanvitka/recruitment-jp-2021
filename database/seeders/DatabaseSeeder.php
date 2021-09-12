<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemTags;
use App\Models\ItemBrand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultUser::class);
        $this->call(ItemGroupSeeder::class);
        ItemBrand::factory(10)->create();
        Item::factory(200)->create();
        ItemTags::factory(200)->create();
    }
}
