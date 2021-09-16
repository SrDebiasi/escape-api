<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('voucher', function (Blueprint $table)
    {
      $table->bigIncrements('id');

      $table->integer('company_id');
      $table->integer('room_id')->nullable();

      $table->boolean('enable');
      $table->boolean('auto');
      $table->string('code');

      $table->integer('minimun_people');
      $table->boolean('percentual');
      $table->double('descount');
      $table->integer('quantity');

      $table->dateTime('start');
      $table->dateTime('end');

      $table->string('day');

      $table->timestamps();
      $table->softDeletes();

      $table->foreign('company_id')->references('id')->on('company');
      $table->foreign('room_id')->references('id')->on('room');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('voucher');
  }
}
