<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('company', function (Blueprint $table)
    {
      $table->bigIncrements('id');
      $table->integer('company_id')->nullable();
      $table->string('name');
      $table->string('uid')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->string('address')->nullable();
      $table->string('zip_code')->nullable();
      $table->string('state')->nullable();
      $table->string('country')->nullable();
      $table->text('logo')->nullable();
      $table->timestamps();
      $table->softDeletes();

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('company');
  }
}
