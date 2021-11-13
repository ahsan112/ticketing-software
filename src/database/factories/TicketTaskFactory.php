<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'target_date' => Carbon::now()->addDays(rand(2,10)),
            'owner_id' => User::where('role', 'employee')->inRandomOrder()->first()->id
        ];
    }
}
