<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('category', ['AUTHENTICATION', 'SUCCESS','VALIDATION','CONFLICT','ERROR']);
             $table->integer('code');
             $table->text('response_message');
             $table->boolean('is_active');
             $table->mediumText('description');
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
        Schema::dropIfExists('response_codes');
    }
}
