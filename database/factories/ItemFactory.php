<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id' => $this->faker->randomElement(ItemBrand::pluck('id')->toArray()),
            'code' => $this->faker->unique()->bothify('###-????'),
            'name' => $this->faker->words(2, true),
        ];
    }
}
