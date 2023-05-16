<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        
        // ResetPassword::createUrlUsing(function ($user, string $token) {
        //     return 'https://example.com/reset-password?token='.$token;
        // });

        // VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //     $spaUrl = "http://spa.test?email_verify_url=".$url;

        //     return (new MailMessage)
        //         ->subject('Verify Email Address')
        //         ->line('Click the button below to verify your email address.')
        //         ->action('Verify Email Address', $spaUrl);
        // });
    }
}
