<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up () {
		Schema::create('tokens', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('access_token');
			$table->string('refresh_token');
			$table->dateTime('expires_in');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down () {
		Schema::dropIfExists('tokens');
	}
}
