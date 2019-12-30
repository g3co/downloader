How to install

```composer install```

```php artisan migrate```

How to run

```php artisan serve``` for run main application

```php artisan queue:listen``` for run background tack handler

Api endpoints

* GET@/api/downloads - list of jobs
* POST@/api/downloads/job

CLI applications
* php artisan downloads:list - list of jobs
* php artisan downloads:create {route} - add new job for download
