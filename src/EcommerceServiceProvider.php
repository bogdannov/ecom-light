<?php

namespace Webmagic\EcommerceLight;

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Router;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\ServiceProvider;
use IvanLemeshev\Laravel5CyrillicSlug\SlugServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use Webmagic\EcommerceLight\Category\CategoryRepo;
use Webmagic\EcommerceLight\Category\CategoryRepoContract;
use Webmagic\EcommerceLight\Console\Commands\UpdateCategoryPosition;
use Webmagic\EcommerceLight\Contracts\Ecommerce as EcommerceContract;
use Webmagic\EcommerceLight\Filtering\FilterRepoContract;
use Webmagic\EcommerceLight\Filtering\FilterRepo;
use Webmagic\EcommerceLight\Filtering\FilterService;
use Webmagic\EcommerceLight\Filtering\FilterServiceContract;
use Webmagic\EcommerceLight\Filtering\OptionRepoContract;
use Webmagic\EcommerceLight\Filtering\OptionGroupContract;
use Webmagic\EcommerceLight\Filtering\OptionGroupRepo;
use Webmagic\EcommerceLight\Filtering\OptionRepo;
use Webmagic\EcommerceLight\Product\ProductExporter;
use Webmagic\EcommerceLight\Product\ProductExporterContract;
use Webmagic\EcommerceLight\Product\ProductRepo;
use Webmagic\EcommerceLight\Product\ProductRepoContract;
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Webmagic\EcommerceLight\Product\ProductSearch;
use Webmagic\EcommerceLight\Product\ProductSearchContract;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Register products service
     */
    public function register()
    {
        $this->mergeConfigs();

        $this->registerEcommerce();
        $this->registerServices();
        $this->registerAdditionalProviders();

        $this->registerCommands();

        $this->loadMigrations();
    }

    /**
     * Merge configs
     */
    protected function mergeConfigs()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/ecommerce.php', 'webmagic.ecommerce'
        );
    }

    /**
     * Register Ecommerce facade
     */
    protected function registerEcommerce()
    {
        $this->app->singleton(EcommerceContract::class, Ecommerce::class);
    }

    /**
     * Registering ecommerce services
     */
    protected function registerServices()
    {
        $this->app->singleton(CategoryRepoContract::class, CategoryRepo::class);

        $this->app->bind(ProductRepoContract::class, ProductRepo::class);
        $this->app->bind(ProductExporterContract::class, ProductExporter::class);
        $this->app->bind(ProductSearchContract::class, ProductSearch::class);

        $this->app->singleton(OptionGroupContract::class, OptionGroupRepo::class);
        $this->app->singleton(OptionRepoContract::class, OptionRepo::class);

        $this->app->singleton(FilterRepoContract::class, FilterRepo::class);
        $this->app->singleton(FilterServiceContract::class, FilterService::class);
    }

    /**
     * Register additional service providers
     */
    protected function registerAdditionalProviders()
    {
        $this->app->register(SlugServiceProvider::class);
        $this->app->register(ExcelServiceProvider::class);
    }

    /**
     * Register commands
     */
    protected function registerCommands()
    {
        $this->commands(
            UpdateCategoryPosition::class
        );
    }

    /**
     * Boot products service
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->registerPublishes();
        $this->registerMiddleware($router);
        $this->registerFactories();
    }

    /**
     * Register all needs publishes
     */
    public function registerPublishes()
    {
        //Migrations publishing
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'migrations');

        //Seeds publishing
        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('seeds'),
        ], 'seeds');

        //Config publishing
        $this->publishes([
            __DIR__.'/config/ecommerce.php' => config_path('webmagic/ecommerce.php')
        ], 'config');

    }

    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registerMiddleware($router)
    {
        $router->middlewareGroup('ecommerce', [
            EncryptCookies::class,
            StartSession::class,
        ]);
    }

    /**
     * Factories registration
     */
    public function registerFactories()
    {
        $this->app->singleton(EloquentFactory::class, function ($app){
            return EloquentFactory::construct($app->make(FakerGenerator::class),  __DIR__.'/database/factories/');
        });
    }

    /**
     * Load migrations
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}