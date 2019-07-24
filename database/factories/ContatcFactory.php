<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Contacts;
use Faker\Generator as Faker;

$factory->define(Contacts::class, function (Faker $faker) {
    return [
        'contact_name'  => $faker->name,
        'contact_phone' => $faker->phonenumber,
        'contact_email' => $faker->unique()->email
    ];
});
