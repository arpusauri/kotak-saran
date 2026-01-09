<?php
// ============================================
// File: app/Providers/AuthServiceProvider.php
// ============================================

namespace App\Providers;

use App\Models\Suggestion;
use App\Policies\SuggestionPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Suggestion::class => SuggestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

?>