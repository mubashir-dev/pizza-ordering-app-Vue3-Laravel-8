<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Pizza;
use Illuminate\Database\Eloquent\Factories\Factory;

class PizzaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pizza::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name(),
            'pizza_category_id'=>2,
            'photo_url'=>'Test',
            'description'=>$this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'ingredients'=>json_encode(['test'=>'test','test_2'=>'test_2']),
            'price'=>$this->faker->numberBetween($min = 1500, $max = 6000),
            'tax'=>$this->faker->numberBetween($min = 1500, $max = 6000),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
