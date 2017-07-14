<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->text('uri');
            $table->enum('method', ['POST', 'GET','PUT','DELETE','PATCH']);
            $table->mediumText('parameters');
            $table->enum('response_type', ['SUCCESS', 'FAILURE','WARNING','PENDING']);
            $table->longText('response');
            $table->text('response_format');
            $table->longText('validations');
            $table->longText('roles');         
            $table->boolean('is_active');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('api_transactions');
    }
}
