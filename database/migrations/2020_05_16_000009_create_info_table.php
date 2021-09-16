<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('info', function (Blueprint $table)
    {
      $table->bigIncrements('id');

      $table->integer('user_id')->nullable();
      $table->integer('company_id')->nullable();

      $table->string('name');
      $table->string('value');
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('user');
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
    Schema::dropIfExists('info');
  }
}
