<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_company', function (Blueprint $table)
    {
      $table->integer('company_id');
      $table->integer('user_id');
      $table->boolean('default');

      $table->foreign('company_id')->references('id')->on('company');
      $table->foreign('user_id')->references('id')->on('user');

      $table->primary(['user_id', 'company_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_company');
  }
}
