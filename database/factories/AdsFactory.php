<?php

use Faker\Generator as Faker;

$factory->define(\App\Ads::class, function (Faker $faker) {
    return [
        'title'=>$faker->text(50),
        'description'=>$faker->text(200),
        'price'=>$faker->numberBetween(1,100),
        'created_at'=>$faker->dateTime($max = 'now'),
        'price'=>$faker->numberBetween(1,1),
        'id_users'=>$faker->numberBetween(1,1),
    ];
});
