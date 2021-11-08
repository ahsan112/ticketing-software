<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(['role' => 'admin']);
        \App\Models\User::factory()->create(['role' => 'manager']);
        \App\Models\User::factory()->create(['role' => 'developer']);
        \App\Models\User::factory()->create(['role' => 'employee']);
    }
}
