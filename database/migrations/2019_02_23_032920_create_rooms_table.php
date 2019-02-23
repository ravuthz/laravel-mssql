<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMrmRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mrm_rooms', function(Blueprint $table)
		{
			$table->integer('room_id', true);
			$table->string('room_name', 50)->nullable();
			$table->string('room_type', 50)->nullable();
			$table->integer('num_member')->nullable();
			$table->string('equipment', 500)->nullable();
			$table->string('description', 500)->nullable();
			$table->integer('modified_by')->nullable();
			$table->dateTime('modified_dt')->nullable();
			$table->boolean('isdeleted')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mrm_rooms');
	}

}
