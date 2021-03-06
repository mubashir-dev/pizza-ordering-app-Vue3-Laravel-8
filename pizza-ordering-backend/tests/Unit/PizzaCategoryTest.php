<?php

namespace Tests\Unit;

use App\Models\PizzaCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
// use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class PizzaCategoryTest extends TestCase
{
    //For Generating fake data
    use WithFaker;
    //Test the Pizza-Category Api show endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategory_list_is_returning_properly()
    {
        $this->withoutExceptionHandling();
        $PizzaCategories = PizzaCategory::factory()->count(5)->create();
        $this->get(route('PizzaCategory.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'PizzaCategories' => [
                    "*" =>
                    [
                        'id',
                        'title',
                        'description',
                        'created_at',
                        'updated_at'
                    ]

                ]
            ]);
    }
    //Test the Pizza-Category Api store endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategory_store_is_working_properly()
    {
        $this->withoutExceptionHandling();
        $data = [
            'title' => $this->faker->name(),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2)
        ];
        $this->post(route('PizzaCategory.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message'
            ]);
    }
    //Test the Pizza-Category Api update endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategory_update_is_working_properly()
    {
        $this->withoutExceptionHandling();
        $PizzaCategory = PizzaCategory::factory()->create();

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ];
        $this->put(route('PizzaCategory.update', $PizzaCategory->id), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);
    }
    //Test the Pizza-Category Api show endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategory_show_is_returning_properly()
    {
        $this->withoutExceptionHandling();
        $PizzaCategory = PizzaCategory::factory()->create();
        $this->get(route('PizzaCategory.show', $PizzaCategory->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'pizza_category' => [

                    'id',
                    'title',
                    'description',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
    //Test the Pizza-Category Api delete endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategory_delete_is_working_properly()
    {
        $this->withoutExceptionHandling();
        $PizzaCategory = PizzaCategory::factory()->create();
        $this->get(route('PizzaCategory.destroy', $PizzaCategory->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'status'
            ]);
    }

    //Test the Pizza-Category Api categories endpoint
    //Testing the response status
    //Testing the response message delivers properly
    public function test_check_if_a_pizzCategories_Custom_list_is_returning_properly()
    {
        $this->withoutExceptionHandling();
        $PizzaCategory = PizzaCategory::factory()->create();
        $this->get(route('PizzaCustomCategories'))
            ->assertStatus(200)
            ->assertJsonStructure([
                "*" =>
                [
                    'id',
                    'title',
                    'description',
                    'created_at',
                    'updated_at'
                ]

            ]);
    }
}
