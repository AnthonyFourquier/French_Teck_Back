<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validate_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            /* $table->string('logo'); */
            $table->string('address');
            $table->string('postcode');
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('category');
            $table->string('association');
            $table->string('description');
            $table->string('website')->nullable();
            $table->string('mail')->unique();
            $table->string('tel')->nullable();
            $table->string('activity');
            $table->integer('fund_raising');
            $table->integer('employees');
            $table->integer('recrutement');
            $table->integer('women');
            $table->integer('ca');
            $table->string('coordinate_x')->nullable();
            $table->string('coordinate_y')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('validate_companies');
    }
}
