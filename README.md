# Laravel Cloudflare

Cloudflare library for Laravel. This library is an expansion of the official Cloudflare PHP SDK

<p align="center">
  <a href="https://travis-ci.org/github/villaflor/laravel-cloudflare">
    <img src="https://img.shields.io/travis/villaflor/laravel-cloudflare.svg?style=flat">
  </a>
  <a href="https://github.com/villaflor/laravel-cloudflare/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/villaflor/laravel-cloudflare.svg?style=flat">
  </a>
  <a href="https://travis-ci.org/github/villaflor/laravel-cloudflare">
    <img src="https://img.shields.io/packagist/php-v/villaflor/laravel-cloudflare">
  </a>
  <a href="https://packagist.org/packages/villaflor/laravel-cloudflare">
    <img src="https://img.shields.io/packagist/v/villaflor/laravel-cloudflare">
  </a>
</p>


## Requirement
+ Cloudflare API token

## Installation
In terminal

```bash
composer require villaflor/laravel-cloudflare

php artisan vendor:publish --provider="Villaflor\Cloudflare\CloudflareServiceProvider"
```

In .env file add this line
```env
CLOUDFLARE_API_TOKEN={API token here}
```


## Methods Available
### CloudflareDNS
+ ``` addRecord ```
+ ``` listRecords ```
+ ``` getRecordDetails ```
+ ``` getRecordID ```
+ ``` updateRecordDetails ```
+ ``` deleteRecord ```

### CloudflareDNSAnalytics
+ ``` getReportTable ```
+ ``` getReportByTime ```

### CloudflareIps
+ ``` listIPs ```

### CloudflareZone
+ ``` addZone ```
+ ``` activationCheck ```
+ ``` pause ```
+ ``` unpause ```
+ ``` getZoneById ```
+ ``` listZones ```
+ ``` getZoneID ```
+ ``` getAnalyticsDashboard ```
+ ``` changeDevelopmentMode ```
+ ``` getCachingLevel ```
+ ``` setCachingLevel ```
+ ``` cachePurgeEverything ```
+ ``` cachePurge ```
+ ``` deleteZone ```

### CloudflareZoneLockdown
+ ``` listLockdowns ```
+ ``` createLockdown ```
+ ``` getLockdownDetails ```
+ ``` updateLockdown ```
+ ``` deleteLockdown ```

### CloudflareZoneSettings
+ ``` getMinifySetting ```
+ ``` getRocketLoaderSetting ```
+ ``` getAlwaysOnlineSetting ```
+ ``` getEmailObfuscationSetting ```
+ ``` getServerSideExcludeSetting ```
+ ``` getHotlinkProtectionSetting ```
+ ``` getBrowserCacheTtlSetting ```
+ ``` updateBrowserCacheTtlSetting ```
+ ``` updateMinifySetting ```
+ ``` updateRocketLoaderSetting ```
+ ``` updateAlwaysOnlineSetting ```
+ ``` updateEmailObfuscationSetting ```
+ ``` updateHotlinkProtectionSetting ```
+ ``` updateServerSideExcludeSetting ```

## Usage

This library uses Dependency injection. Dependency injection is a fancy phrase that essentially means this: class dependencies are "injected" into the class via the constructor or, in some cases, "setter" methods.

```php
use Villaflor\Cloudflare\CloudflareDNS;

class MyClass
{
    private $cloudflareDNS;

    public function __construct(CloudflareDNS $cloudflareDNS)
    {
        $this->cloudflareDNS = $cloudflareDNS;
    }

    public function UpdateDNS()
    {
        $details = [
            'type' => 'A',
            'name' => 'my-domain.com',
            'content' => '1.2.3.4',
            'ttl' => 1,
            'proxied' => true,
        ];

        return $this->cloudflareDNS->updateRecordDetails('zone-id', 'record-id', $details);
    }
    
    public function DetailDNS()
    {
        return $this->cloudflareDNS->getRecordDetails('zone-id', 'record-id');
    }
    
    public function ListDNS()
    {
        return $this->cloudflareDNS->listRecords('zone-id');
    }
}
```
