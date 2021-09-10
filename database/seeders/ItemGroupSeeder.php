<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ItemGroup::updateOrCreate([
            'name' => 'Makanan',
        ], [
            'name' => 'Makanan',
        ]);

        \App\Models\ItemGroup::updateOrCreate([
            'name' => 'Minuman',
        ], [
            'name' => 'Minuman',
        ]);
    }
}
