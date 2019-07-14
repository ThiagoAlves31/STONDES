<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lents;
use Faker\Generator as Faker;

$factory->define(Lents::class, function (Faker $faker) {
    return [
        'contact_id' => rand(1,10),
        'product_id' => function () {
            return factory(App\Product::class)->create()->id;
        },
        'lent_date' => $faker->date()
    ];
});
