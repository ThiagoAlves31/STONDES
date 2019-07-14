<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'type' => (rand(0,1) == true) ? 'CD' : 'Livro',
        'name' => $faker->name,
        'description' =>$faker->text
    ];
});
