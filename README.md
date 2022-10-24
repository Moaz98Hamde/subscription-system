<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a>
</p>

<p align="center">
<a href="https://stripe.com/" target="_blank">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png" width="400" alt="Laravel Logo">
</a>
</p>

# Subscription system

Subscription system built on top of [Laravel Framework](https://laravel.com) and [stripe API](https://stripe.com/)

## installation & setup

create account on stripe : https://stripe.com/

Create new product & name it ['plan'](https://dashboard.stripe.com/test/products/create) with two types of subscriptions (prices) monthly & yearly



Install composer packages

> $ composer install

Create new database

Fill the following env variables in .env file

> DB_DATABASE

> DB_USERNAME

> DB_PASSWORD

> STRIPE_KEY

> STRIPE_SECRET

> PRODUCT_NAME=plan

> MONTHLY_SUB_ID

> MONTHLY_PRICE

> YEARLY_SUB_ID

> YEARLY_PRICE

Run migrations & seeds

> $ php artisan migrate --seed

Run Subscription system app

> $ php artisan serve

Seeded admin email: admin@admin.com , password: secret  
