<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_categories_successful_page()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

    public function test_categories_create_successful_page()
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertViewIs('admin.categories.create')->assertStatus(200);
    }


    public function test_order_orderParsing_return_json_page()
    {
        $faker = Factory::create();
        $userName = $faker->userName();
        $phone = $faker->phoneNumber();
        $email = $faker->email();
        $description = $faker->text(100);
        $data = [
            'userName'=> $userName,
            'phone' => $phone,
            'email' => $email,
            'description' => $description
        ];
        $response = $this->post(route('order.store', $data));
        $response->assertJson($data)->assertStatus(200);
    }

    public function test_feedback_create_successful_page()
    {
        $response = $this->get(route('feedback.index'));
        $response->assertViewIs('feedback.create')->assertStatus(200);
    }
}
