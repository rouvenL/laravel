<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); //primary key
            $table->integer('company_id')->unsigned(); //foreign key
            $table->string('surname');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();
            $table->engine='InnoDB';
        });
        
        Schema::table('users', function(Blueprint $table){
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
        Schema::dropIfExists('users');
        
        Schema::table('users', function (Blueprint $table){
           $table->dropForeign('users_company_id_foreign'); 
        });
    }
}
