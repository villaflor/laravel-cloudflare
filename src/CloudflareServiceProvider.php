<?php


namespace Villaflor\Cloudflare;


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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath() => config_path('cloudflare-villaflor.php'),
        ]);
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/cloudflare-villaflor.php';
    }
}