<?php

use App\Token;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
	static $password;

	return [
		'name'     => $faker->name,
		'email'    => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
	];
});

$factory->define(Token::class, function (Faker $faker) {
	return [
		'user_id' => $faker->randomElement(range(1, 10)),
		'access_token' => str_random(50),
		'refresh_token' => str_random(50),
		'expires_in' => Carbon::now()->addDays(5)->toDateTimeString(),
	];
});