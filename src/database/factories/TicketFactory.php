<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'ticket_type_id' => 1,
            'department_id' => 1,
            'created_by_id' => 1,
            'updated_by_id' => 1,
        ];
    }
}
