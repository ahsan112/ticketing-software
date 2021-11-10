<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\TicketApproval;
use App\Models\TicketTask;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-ticket', fn(User $user) => $user->isManager() || $user->isAdmin());
        
        Gate::define('manage-task', fn(User $user) => $user->isDeveloper() || $user->isManager() || $user->isAdmin());

        Gate::define('complete', fn(User $user, TicketTask $task) => $user->id == $task->owner_id || $user->isAdmin());

        Gate::define('approve', fn(User $user, TicketApproval $approval) => $user->id == $approval->owner_id || $user->isAdmin());

        Gate::define('create-approver', fn(User $user) => $user->isDeveloper() || $user->isManager() || $user->isAdmin());
        
        Gate::define('set-role', fn(User $user) => $user->isAdmin());

        Gate::define('update', function(User $user, Ticket $ticket) {
            return $user->isAdmin() || $user->isManager() || $user->isDeveloper() || $user->id == $ticket->created_by_id;
        });
    }
}
