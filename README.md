# sample-products
test task for PIN

## How to add to project

add following in composer.json:

```js
{
  require: {
   
   "sample-products" : "1.0.0"
  },
  
  "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/ashgaliyev/sample-products"
      }
  ]
}
```

then run 
```$ composer update ```

## After package install

0. Authorization must be exists for using package:

  ```
  $ php artisan make:auth
  ```
  
2. Then you need to migrate database to create users table (if not exists) and create sample_products table:

  ```
  $ php artisan migrate
  ```

3. Add service provider of the package to providers section of your app:

  ```php
    'providers' => [
       //...
       AndreyAsh\SampleProducts\SampleProductsServiceProvider::class,
     ],
  ```
4. ServiceContainer must deliver user type by calling ``` app('current_user_type')```. In my case I simple add following to bootstrap/app.php before return

  ```php
    $app->bind('current_user_type', function($app) {
      return 'admin';
    });
  ```
5. Package will be available on myapp.mydomain/sample-products

