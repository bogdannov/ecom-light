<?php

namespace Webmagic\EcommerceLight;

use Illuminate\Routing\Router;
use Webmagic\Dashboard\Dashboard;

class EcommerceDashboardServiceProvider extends EcommerceServiceProvider
{
    /**
     * Add dashboard config for merging
     */
    protected function mergeConfigs()
    {
        parent::mergeConfigs();

        $this->mergeConfigFrom(
            __DIR__.'/DashboardIntegration/config/ecommerce_dashboard.php', 'webmagic.dashboard.ecommerce'
        );
    }

    /**
     * Add registration publishes for dashboard
     */
    public function registerPublishes()
    {
        parent::registerPublishes();

        //Config publishing
        $this->publishes([
            __DIR__.'/DashboardIntegration/config/ecommerce_dashboard.php' => config_path('webmagic/dashboard/ecommerce.php'),
        ], 'config');

        //Views publishing
        $this->publishes([
            __DIR__.'/DashboardIntegration/resources/views/' => base_path('resources/views/vendor/ecommerce/'),
        ], 'views');
    }

    /**
     * Boot products service
     * @param Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $this->registerRoutes();
        $this->loadViews();

        $this->includeMenuForDashboard();
    }

    /**
     * Register routes
     */
    protected function registerRoutes()
    {
        //Routs registering
        $this->loadRoutesFrom(__DIR__.'/DashboardIntegration/Http/routes_dashboard.php');
    }

    /**
     * Register loading views
     */
    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/DashboardIntegration/resources/views', 'ecommerce');
    }

    /**
     * Including menu items for new dashboard
     */
    public function includeMenuForDashboard()
    {
        $menu_item_config = config('webmagic.dashboard.ecommerce.dashboard_menu_item');

        //Add menu into global menu
        $dashboard = app()->make(Dashboard::class);
        $dashboard->getMainMenu()->addMenuItems($menu_item_config);
    }
}