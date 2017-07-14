<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auth_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->enum('permission_type', ['READ', 'WRITE']);    
            $table->boolean('is_active'); 
            $table->foreign('role_id')->references('id')->on('roles'); 
            $table->foreign('auth_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');    
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
        Schema::dropIfExists('permissions');
    }
}
