
# Superban

A package that contains a middlware which has the ability to ban client completely for a period of time


## Installation

superban can be installed with composer

```bash
  composer required themitope/superban
```
For Laravel 5.5 and above, the package will automatically register provider.

For Laravel 5.4 and below add ```\Themitope\Superban\SuperBanServiceProvider::class``` to the ```provider``` section of your ```config/app.php```.

This package uses Laravel rate limiter, so make sure you configure your cache driver by changing the ```CACHE_DRIVER``` key in your ```.env```. 

If your cache driver is database, the followings keys should be present in your ```.env``` file with their corresponding values.

```bash
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
```
If your cache driver is redis, the followings keys should be present in your ```.env``` file with their corresponding values.
```bash
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
```

## Usage/Examples
Add the ```superban``` middleware to your routes and specify the necessary parameters like this:

```php
Route::middleware(['superban:200,2,1440])->group(function () {
   Route::post('/thisroute', function () {
       // ...
   });
 
   Route::post('anotherroute', function () {
       // ...
   });
});

```
Where 200 is the number of allowed request, 2 is the number of minutes the request is allowed to happen and 1440 is the number of minutes the client will be banned for


## Authors

- [Ogunleye Oluwatosin (@themitope)](https://www.github.com/themitope)

