<?php


namespace Villaflor\Cloudflare;


use Cloudflare\API\Adapter\Guzzle;
use Illuminate\Support\ServiceProvider;

class CloudflareServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'cloudflare-villaflor');

        $config = config('cloudflare-villaflor');

        $this->app->singleton(
            APIKey::class,
            function ($app) use ($config) {
                return new APIKey($config['api_token']);
            }
        );

        $this->app->singleton(
            Guzzle::class,
            function ($app) {
                return new Guzzle($app->make(APIKey::class));
            }
        );

        $this->app->bind(
            CloudflareDNS::class,
            function ($app) {
                return new CloudflareDNS($app->make(Guzzle::class));
            }
        );

        $this->app->bind(
            CloudflareDNSAnalytics::class,
            function ($app) {
                return new CloudflareDNSAnalytics($app->make(Guzzle::class));
            }
        );

        $this->app->bind(
            CloudflareIps::class,
            function ($app) {
                return new CloudflareIps($app->make(Guzzle::class));
            }
        );

        $this->app->bind(
            CloudflareZone::class,
            function ($app) {
                return new CloudflareZone($app->make(Guzzle::class));
            }
        );

        $this->app->bind(
            CloudflareZoneLockdown::class,
            function ($app) {
                return new CloudflareZoneLockdown($app->make(Guzzle::class));
            }
        );

        $this->app->bind(
            CloudflareZoneSettings::class,
            function ($app) {
                return new CloudflareZoneSettings($app->make(Guzzle::class));
            }
        );
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/cloudflare-villaflor.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([$this->configPath() => config_path('cloudflare-villaflor.php'),]);
    }
}