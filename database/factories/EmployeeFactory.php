<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'department_id' => \App\Department::all()->random()->id,
        'name' => $faker->name,
        'father_name' => $faker->firstNameMale,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
