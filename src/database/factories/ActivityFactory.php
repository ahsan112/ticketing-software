<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $changes = [
            ["before" => ["title" => "test title"], "after" => ["title" => "a new title"]],
            ["before" => ["title" => "test title", "description" => "test description"], "after" => ["title" => "a new title", "description" => "a new description"]],
            ["before" => ["target_date" => "2021-11-13"], "after" => ["target_date" => "2021-12-13"]],
            ["before" => ["priority" => "Urgent"], "after" => ["priority" => "High"]],
            ["before" => ["priority" => "High"], "after" => ["priority" => "Normal"]],
            ["before" => ["priority" => "normal"], "after" => ["priority" => "Urgent"]],
            ["before" => ["status" => "in progress"], "after" => ["status" => "testing"]],
            ["before" => ["status" => "testing"], "after" => ["status" => "waiting approval"]],
            ["before" => ["status" => "waiting approval"], "after" => ["status" => "ready for deploy"]],
            ["before" => ["status" => "accepted"], "after" => ["status" => "parked"]],
        ];
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => 'updated',
            'changes' => $changes[array_rand($changes)]
        ];
    }
}
