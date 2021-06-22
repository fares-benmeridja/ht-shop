<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Policies\ContactPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
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
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        Order::class   => OrderPolicy::class,
        Contact::class => ContactPolicy::class,
        User::class    => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-invoice', function (User $user, Order $order){
            return ( $user->is_main_admin || $user->is_editor_admin ) || $user->id === $order->user_id;
        });

        Gate::define("published", function (User $user){
            if ($user->is_main_admin || $user->is_editor_admin)
                return true;

            return false;
        });

        Gate::define('view-manage-admin', function(User $user){
           return $user->is_main_admin;
        });

        Gate::define('view-orders', function(User $user){
           return $user->is_main_admin || $user->is_editor_admin;
        });

        Gate::define('view-inbox', function(User $user){
           return $user->is_main_admin || $user->is_editor_admin;
        });
    }
}
