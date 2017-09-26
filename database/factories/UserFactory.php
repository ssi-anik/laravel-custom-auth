<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
	static $password;

	return [
		'name'     => $faker->name,
		'email'    => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'api_token' => str_random(40),
	];
});