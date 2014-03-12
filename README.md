## Laravel Bootstrap


This is a simple [Laravel](http://laravel.com/) project with user authentication ready to use.
It uses [Bootstrap](http://getbootstrap.com) for the layout.

## How to run

1. Go to the project folder and run `composer update` to install the dependencies
2. Set the database configs at `app/config/database.php`
3. Set the email configs at `app/config/mail.php`
4. Run the migrantions and seed `php artisan migrate:refresh --seed`
5. Go to the project url and you will see the login button
  * You can use the email `admin@admin.com` and the password `testtest`


## FAQ

1. How to change the user email?
  * Go to the `app/seeds/UsersTableSeeder.php` change the email and passord and run the migrations/seeds again `php artisan migrate:refresh --seed` 

2. How to change the email template?
  * Go to `app/views/emails/auth/reminder.blade.php` and change the template

3. How to redirect to the admin dashboard after login?
  * Go to `app/controllers/AuthController.php L:42` and make your changes.


### License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) using same license as [Laravel](http://laravel.com/)
