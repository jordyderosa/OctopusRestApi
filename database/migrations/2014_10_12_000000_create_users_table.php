<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades;

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
            $table->increments('id');
            $table->string('name',20);
            $table->string('email',50)->unique();
            $table->string('authtoken', 20)->unique();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            ['name'=>'testuser','email' => 'test@octopuslabs.com', 'authtoken' => "TkpJe8qr9hjbqPwCHi0n"]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
