<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
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

        TicketType::factory()->create(['name' => 'feature']);
        TicketType::factory()->create(['name' => 'bug']);

        TicketStatus::factory()->createMany([
            ['name' => 'parked'],
            ['name' => 'in progress'],
            ['name' => 'testing'],
            ['name' => 'awaiting approval'],
            ['name' => 'ready for deploy'],
        ]);

        TicketPriority::factory()->createMany([
            ['name' => 'urgent'],
            ['name' => 'high'],
            ['name' => 'normal'],
            ['name' => 'low'],
        ]);

        Ticket::factory(3)->create();
        Ticket::factory(3)->create([
            'created_by_id' => 2,
            'updated_by_id' => 2,
        ]);
        Ticket::factory(3)->create([
            'created_by_id' => 3,
            'updated_by_id' => 3,
        ]);
    }
}
