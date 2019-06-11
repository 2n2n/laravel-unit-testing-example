<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TestEvent extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function test_user_can_view_events()
    {
        $response = $this->get('/events');
        $response->assertStatus(200);
        $response->assertViewHas('events');
    }

    public function test_title_should_be_required_validation()
    {
        $data = [
            'title' => '',
            'description' => $this->faker->paragraph(),
        ];

        $response = $this->post('/events', $data);
        $response->assertSessionHasErrors();
    }

    /** @depends test_title_should_be_required_validation */
    public function test_description_should_be_required_validation()
    {
        $data = [
            'title' => '',
            'description' => '',
        ];

        $response = $this->post('/events', $data);
        $response->assertSessionHasErrors();
    }

    /** @depends test_description_should_be_required_validation */
    public function test_user_can_create_event()
    {
        $data = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];

        $response = $this->post('/events', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('events', $data);
    }
}
