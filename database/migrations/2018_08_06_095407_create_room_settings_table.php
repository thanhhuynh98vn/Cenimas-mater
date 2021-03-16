<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomSettingsTable.
 */
class CreateRoomSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('room_id');
            $table->integer('alphabet_id');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('room_settings');
	}
}
