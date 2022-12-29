<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Products\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return Product::factory()->make();

    // return [
    //     'name'                => $faker->name,
    //     'product_category_id' => '',
    //     'price'               => $faker->name,
    //     'stock'               => 12
    // ];
});
