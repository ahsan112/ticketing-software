<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
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
            'ticket_type_id' => TicketType::inRandomOrder()->first()->id,
            'target_date'   => Carbon::now()->addMonths(rand(1,12)),
            'department_id' => Department::inRandomOrder()->first()->id,
            'priority_id'   => TicketPriority::inRandomOrder()->first()->id,
            'status_id'     => TicketStatus::inRandomOrder()->first()->id,
            // 'created_by_id' => User::where('role', 'employee')->inRandomOrder()->first()->id,
            'created_by_id' => User::inRandomOrder()->first()->id,
            'updated_by_id' => User::where('role', 'developer')->inRandomOrder()->first()->id,
        ];
    }
}
