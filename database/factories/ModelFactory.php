<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\SquareCreditCard;
use Carbon\Carbon;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $email = $faker->unique()->safeEmail;

    return [
        'first_name'     => $faker->name,
        'last_name'      => $faker->name,
        'email'          => $email,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token'      => md5($email . config('app.token_salt')),
    ];
});

$factory->state(App\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'is_admin' => true,
    ];
});

$factory->define(App\Models\Organization::class, function (Faker\Generator $faker) {
    return [
        'name'    => "{$faker->company} {$faker->companySuffix}",
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id'          => function () {
            return factory('App\Models\User')->create()->id;
        },
        'commentable_type' => 'App\Models\Fast',
        'commentable_id'   => function () {
            return factory('App\Models\Fast')->create()->id;
        },
        'contents'         => $faker->sentence,
    ];
});

$factory->state(App\Models\Comment::class, 'fast', function (Faker\Generator $faker) {
    return [
        'commentable_id'   => function () {
            return factory('App\Models\Fast')->create()->id;
        },
        'commentable_type' => 'App\Models\Fast',
    ];
});

$factory->define(App\Models\Fast::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => function () {
            return factory('App\Models\User')->create()->id;
        },
        'category_id' => function () {
            return factory('App\Models\Category')->create()->id;
        },
        'subtype'     => $faker->word,
        'start'       => Carbon::now()->addDays($faker->numberBetween(1, 3)),
        'end'         => Carbon::now()->addDays($faker->numberBetween(0, 4)),
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Models\Gender::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'icon' => $faker->word,
    ];
});

$factory->define(App\Models\Subscription::class, function (Faker\Generator $faker) {
    return [
        'user_id'             => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'payment_method_id'   => $faker->numberBetween(1),
        'payment_method_type' => '',
        'expires_at'          => $faker->date(),
        'fee'                 => $faker->numberBetween(0, 25),
    ];
});

$factory->state(App\Models\Subscription::class, 'expired', function (Faker\Generator $faker) {
    return [
        'expires_at' => Carbon::now()->subMonth(),
    ];
});

$factory->state(App\Models\Subscription::class, 'valid', function (Faker\Generator $faker) {
    return [
        'expires_at' => Carbon::now()->addMonth(),
    ];
});

$factory->state(App\Models\Subscription::class, 'square', function (Faker\Generator $faker) {
    /** @var SquareCreditCard $payment_method */
    $payment_method = factory(App\Models\SquareCreditCard::class)->create();

    return [
        'payment_method_id'   => $payment_method->id,
        'payment_method_type' => App\Models\SquareCreditCard::class,
    ];
});

$factory->define(App\Models\SquareCreditCard::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => $faker->password,
        'card_id'     => $faker->password,
    ];
});
