<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemTags;
use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemTagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Itemtags::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => $this->faker->randomElement(Tags::pluck('id')->toArray()),
            'item_id' => $this->faker->randomElement(Item::pluck('id')->toArray()),
            'name' => $this->faker->words(2, true),
        ];
    }
}
