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

use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $email = $faker->unique()->safeEmail;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $email,
        'password' => bcrypt($email),
        'remember_token' => str_random(10),
        'hmo_id' => 1,
        'entity_id' => 1,
        'role_id' => 1,
        'activated' => 0,
        'date_activated' => Carbon::now(),
        'last_login' => Carbon::now(),
    ];
});

$factory->define(App\Hmo::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->company,
        'street' => $faker->streetName,
        'email' => $faker->unique()->companyEmail,
        'phone_office' => $faker->unique()->phoneNumber,
        'phone_mobile' => $faker->unique()->phoneNumber,
        'city' => $faker->unique()->city,
        'state' => 'Lagos',
        'country' => 'Nigeria',
        'lg' => 'Lagos Mainland',
        'created_by' => 'bolaji@gmail.com',
        'activated' => 0
    ];
});

$factory->define(App\Enrollee::class, function(Faker\Generator $faker){
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'organization_id' => 1,
        'hmo_id' => 1,
        'plan_id' => 1,
        'dependent_id' => 3,
        'generated_id' => strtoupper(substr($faker->unique()->company, 0, 3)).'/LAG/0000'.$faker->numberBetween(1,20),
        'image_url' => $faker->imageUrl(200, 200, 'people'),
        'phone' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'city' =>  $faker->unique()->city,
        'lg' => 'Lagos Mainland',
        'street_address' => $faker->streetAddress,
        'state' => 'Lagos',
        'country' => 'Nigeria',
        'status' => 0,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'enrollee_type' => 'child'
    ];
});

$factory->define(App\Organization::class, function(Faker\Generator $faker){
   return [
       'name' => $faker->unique()->company,
       'hmo_id' => 1,
       'plan_id' => 1,
       'generated_id' => strtoupper(substr($faker->unique()->company, 0, 3)).'/LAG/0000'.$faker->unique()->numberBetween(1,20),
       'phone' => $faker->unique()->phoneNumber,
       'email' => $faker->unique()->safeEmail,
       'industry' => 'Communication and Technology',
       'city' =>  $faker->unique()->city,
       'lg' => 'Lagos Mainland',
       'street_address' => $faker->streetAddress,
       'state' => 'Lagos',
       'country' => 'Nigeria',
   ];
});

$factory->define(App\Plan::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->unique()->lastName,
        'hmo_id' => 1,
        'premium' => ceil(($faker->unique()->biasedNumberBetween($min = 2000, $max = 10000)) / 100 ) * 100,
        'cover_limit' => ceil(($faker->unique()->biasedNumberBetween($min = 100000, $max = 700000)) / 1000 ) * 1000,
        'procedure' => null,
        'ailment' => null,
    ];
});
