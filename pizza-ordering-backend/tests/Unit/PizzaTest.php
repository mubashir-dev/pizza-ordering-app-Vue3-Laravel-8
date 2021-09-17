<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class PizzaTest extends TestCase
{
    //For Generating fake data
    use WithFaker;
    /**
     * A unit test to check if the pizza-listing endpoint is returning data properly or not
     * Testing the response status
     * Testing the response message delivers properly

     */
    public function test_check_if_a_pizz_list_is_returning_properly()
    {
        $pizzas = Pizza::factory()->count(5)->create();
        $this->withoutExceptionHandling();
        $this->get(route('Pizza.index'))
            ->assertStatus(200);
    }
    /**
     * A unit test to check if the pizza-single endpoint is returning data properly or not
     * Testing the response status
     * Testing the response message delivers properly

     */
    public function test_check_if_a_pizz_single_is_returning_properly()
    {
        $pizza = Pizza::factory()->create();
        $this->withoutExceptionHandling();
        $this->get(route('Pizza.show',$pizza->id))
            ->assertStatus(200);
    }
    /**
     * A unit test to check if the pizza-storing endpoint is storing data properly or not
     * Testing the response status
     * Testing the response message delivers properly

     */
    public function test_check_if_a_pizz_is_store_properly()
    {
        $this->withoutExceptionHandling();
        //Fake Storage
        Storage::fake('avatars');
        $data = [
            'title'=>$this->faker->name(),
            'pizza_category_id' => 2,
            'photo_url' => UploadedFile::fake()->image('avatar.jpg'),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'ingredients' => json_encode(['test' => 'test', 'test_2' => 'test_2']),
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'tax' => $this->faker->numberBetween($min = 1500, $max = 6000),
        ];
        $this->post(route('Pizza.store'),$data)
            ->assertStatus(201);
    }
    /**
     * A unit test to check if the pizza-updating endpoint is storing data properly or not
     * Testing the response status
     * Testing the response message delivers properly

     */
    public function test_check_if_a_pizz_is_updating_properly()
    {
        $pizza = Pizza::factory()->create();

        $this->withoutExceptionHandling();
        //Fake Storage
        Storage::fake('avatars');
        $data = [
            'title'=>$this->faker->name(),
            'pizza_category_id' => 2,
            'photo_url' => UploadedFile::fake()->image('avatar.jpg'),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'ingredients' => json_encode(['test' => 'test', 'test_2' => 'test_2']),
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'tax' => $this->faker->numberBetween($min = 1500, $max = 6000),
        ];
        $this->put(route('Pizza.update',$pizza->id),$data)
            ->assertStatus(200);
    }
     /**
     * A unit test to check if the pizza-delete endpoint is deleting data properly or not
     * Testing the response status
     * Testing the response message delivers properly

     */
    public function test_check_if_a_pizz_is_deleting_properly()
    {
        $pizza = Pizza::factory()->create();

        $this->withoutExceptionHandling();
        $this->delete(route('Pizza.destroy',$pizza->id))
            ->assertStatus(200);
    }
}
