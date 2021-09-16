<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('room', function (Blueprint $table)
    {
      $table->bigIncrements('id');
      $table->integer('company_id');
      $table->boolean('enable');
      $table->string('name');

      $table->integer('vacancies');
      $table->integer('play_time');
      $table->double('room_price')->nullable();
      $table->double('ticket_price')->nullable();

      $table->integer('schedule_type');
      $table->text('picture_large')->nullable();
      $table->text('picture_short')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('company_id')->references('id')->on('company');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('room');
  }
}
