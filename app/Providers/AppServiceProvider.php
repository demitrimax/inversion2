<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Auth;
use App\Models\tareas;
use Carbon\Carbon;
use Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //\App\Blade\Components::make()->register();
        Blade::component('components.card', 'card');

        Schema::defaultStringLength(191);
        view()->composer('*', function($view)
      {
          if (Auth::check()) {
              $CurrentUserId = Auth::user()->id;
              $currentDate = date('Y-m-d');
              $vartareas = tareas::where('user_id',$CurrentUserId)->where('terminado',null)->get();
              $nuevastareas = tareas::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('terminado',null)->get();
              //dd($nuevastareas);
              $view->with(compact('vartareas','nuevastareas'));

              //View::share('solicitudess',solicitudes::all());
          }else {
            $vartareas = null;
            $nuevastareas = null;
              $view->with(compact('vartareas','nuevastareas'));
          }
      });
      //Artisan::call('App\Http\Controllers\mailtareasController@tareasVencidas');
    }
}
