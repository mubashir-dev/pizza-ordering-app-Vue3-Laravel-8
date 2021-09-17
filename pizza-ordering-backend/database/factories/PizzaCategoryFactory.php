<?php

namespace Database\Factories;
use Carbon\Carbon;
use App\Models\PizzaCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PizzaCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PizzaCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name(),
            'description'=>$this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
