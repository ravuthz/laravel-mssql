<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrm_meeting_schedule', function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('subjects', 350)->nullable();
            $table->string('start_time', 10)->nullable();
            $table->string('end_time', 10)->nullable();
            $table->integer('room_id')->nullable();
            $table->string('requestedby', 150)->nullable();
            $table->string('leadby', 150)->nullable();
            $table->string('recordedby', 50)->nullable();
            $table->integer('mr_id')->nullable()->comment('1 = Internal, 2 = National, 3 = International');
            $table->string('num_member', 50)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('result')->nullable();
            $table->integer('status')->nullable()->comment('1 = Booking, 2 = Meeting, 3 = Finish, 4 = Cancel');
            $table->string('status_comment', 500)->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_dt')->nullable();
            $table->integer('modified_by')->nullable();
            $table->dateTime('modified_dt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mrm_meeting_schedule');
    }

}
