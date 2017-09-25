<?php

use App\Token;
use Illuminate\Database\Seeder;

class TokenSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run () {
		factory(Token::class, 10)->create([]);
	}
}
