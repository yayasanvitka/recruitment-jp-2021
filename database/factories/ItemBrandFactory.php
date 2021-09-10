<?php

namespace Database\Factories;

use App\Models\ItemBrand;
use App\Models\ItemGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemBrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemBrand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => $this->faker->randomElement(ItemGroup::pluck('id')->toArray()),
            'code' => $this->faker->unique()->bothify('###-???'),
            'name' => $this->faker->word(),
        ];
    }
}
