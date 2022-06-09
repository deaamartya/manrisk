<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\PengajuanMitigasi;
use Auth;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->mapWebRoutes();
        $this->mapRiskOfficerRoutes();
        $this->mapRiskOwnerRoutes();
        $this->mapPenilaiRoutes();
        $this->mapAdminRoutes();
        $this->mapPenilaiIndhanRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.user.sidebar', function ($view) {
            $counts = PengajuanMitigasi::where('status', '=', 0)->count();
            return $view->with('counts', $counts);
        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapRiskOfficerRoutes()
    {
        Route::middleware('web')
            ->prefix('risk-officer')
            ->namespace($this->namespace)
            ->group(base_path('routes/risk-officer.php'));

        }
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapRiskOwnerRoutes()
    {
        Route::middleware('web')
            ->prefix('risk-owner')
            ->namespace($this->namespace)
            ->group(base_path('routes/risk-owner.php'));
    }

    protected function mapPenilaiRoutes()
    {
        Route::middleware('web')
            ->prefix('penilai')
            ->namespace($this->namespace)
            ->group(base_path('routes/penilai.php'));
    }

    protected function mapPenilaiIndhanRoutes()
    {
        Route::middleware('web')
            ->prefix('penilai-indhan')
            ->namespace($this->namespace)
            ->group(base_path('routes/penilai-indhan.php'));
    }
    
}
