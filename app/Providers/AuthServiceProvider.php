<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //error showing -SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes
        Schema::defaultStringLength(200);
        //passport included
        Passport::routes();
       // Passport::loadKeysFrom('/secret-keys/oauth');
        // Passport::tokensExpireIn(now()->addSeconds(15));
        // Passport::refreshTokensExpireIn(now()->addSeconds(15));
        // Passport::personalAccessTokensExpireIn(now()->addSeconds(15));
    }
}
