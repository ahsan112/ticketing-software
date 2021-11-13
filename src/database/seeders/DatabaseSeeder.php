<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketTask;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\ActivityFactory;
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
        \App\Models\User::factory()->create(['role' => 'admin', 'email' => 'admin@admin.com']);
        \App\Models\User::factory()->create(['role' => 'manager', 'email' => 'manager@manager.com']);
        \App\Models\User::factory()->create(['role' => 'developer', 'email' => 'developer@developer.com']);
        \App\Models\User::factory(4)->create(['role' => 'developer']);
        \App\Models\User::factory()->create(['role' => 'employee', 'email' => 'john@doe.com']);
        \App\Models\User::factory(20)->create(['role' => 'employee']);

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

        Department::factory()->createMany([
            ['name' => 'HR'],
            ['name' => 'Accounting'],
            ['name' => 'IT'],
            ['name' => 'Sales'],
            ['name' => 'Engineering'],
            ['name' => 'Procurement']
        ]);

        Ticket::factory()
            ->count(30)
            ->has(TicketTask::factory()->count(5), 'tasks')
            ->has(Activity::factory()->count(3))
            ->create();
    }
}
