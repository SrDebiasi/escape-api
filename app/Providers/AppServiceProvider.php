<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('App\Repositories\Interfaces\RoomRepositoryI', 'App\Repositories\RoomRepository');
    $this->app->bind('App\Repositories\Interfaces\CompanyRepositoryI', 'App\Repositories\CompanyRepository');
    $this->app->bind('App\Repositories\Interfaces\InfoRepositoryI', 'App\Repositories\InfoRepository');
    $this->app->bind('App\Repositories\Interfaces\TimetableRepositoryI', 'App\Repositories\TimetableRepository');
    $this->app->bind('App\Repositories\Interfaces\ScheduleRepositoryI', 'App\Repositories\ScheduleRepository');
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
