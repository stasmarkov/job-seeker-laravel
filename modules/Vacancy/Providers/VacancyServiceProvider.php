<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Candidate\Models\CandidateProfile;
use Modules\Candidate\Policies\CandidateProfilePolicy;
use Modules\Vacancy\Listeners\VacancyCreatedSubscriber;
use Modules\Vacancy\Listeners\VacancyDeletedSubscriber;
use Modules\Vacancy\Listeners\VacancyViewedSubscriber;
use Modules\Vacancy\Models\Vacancy;
use Modules\Vacancy\Policies\VacancyPolicy;

/**
 * The vacancy modules service provider.
 */
class VacancyServiceProvider extends ServiceProvider {

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerEventSubscribers();
    $this->registerPolicies();
    $this->registerRoutes();

    // Load migrations from module.
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    // Load module configs.
    $this->mergeConfigFrom(__DIR__ . '/../config.php', 'vacancy');
  }

  /**
   * {@inheritdoc}
   */
  public function registerPolicies() {
    Gate::policy(Vacancy::class, VacancyPolicy::class);
  }

  /**
   * {@inheritdoc}
   */
  public function registerEventSubscribers(): void {
    Event::subscribe(VacancyCreatedSubscriber::class);
    Event::subscribe(VacancyDeletedSubscriber::class);
    Event::subscribe(VacancyViewedSubscriber::class);
  }

  /**
   * Register routes.
   */
  public function registerRoutes() {
    Route::middleware('web')
      ->group(base_path('modules/Vacancy/routes.php'));

    Route::middleware('api')
      ->prefix('api/v1')
      ->group(base_path('modules/Vacancy/api.v1.php'));
  }

}
