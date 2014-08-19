<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
                {
                    $table->increments('id');
                    $table->string('username')->unique;
                    $table->string('password');
                    $table->string('remember_token')->nullable();
                    $table->boolean('can_delete')->nullable();
                    $table->boolean('can_add')->nullable();
                    $table->boolean('administrator')->nullable();
                    $table->date('created_at');
                    $table->date('updated_at');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
