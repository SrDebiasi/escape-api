<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('schedule', function (Blueprint $table)
    {
      $table->bigIncrements('id');

      $table->integer('timetable_id');
      $table->integer('user_id')->nullable();
      $table->integer('voucher_id')->nullable();

      $table->string('name');
      $table->string('phone');
      $table->date('day');
      $table->string('email');
      $table->integer('quantity');

      $table->double('payment_value');
      $table->double('payment_type');
      $table->boolean('confirmed');
      $table->boolean('paid');
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('timetable_id')->references('id')->on('timetable');
      $table->foreign('user_id')->references('id')->on('user');
      $table->foreign('voucher_id')->references('id')->on('voucher');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('schedule');
  }
}
