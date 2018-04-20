<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
        'company_name' => $faker->name,
        'operating_status' => 'Active',
    ];
});

