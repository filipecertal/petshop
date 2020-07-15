<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', 50);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->rememberToken();
            $table->timestamps();
            $table->integer('contactNumber')->unique();
            $table->string('gender', 10);
            $table->integer('is_admin')->default(0);

        });

        DB::table('users')->insert(array(
            'name' => 'Administrador',
            'email' => 'admin@petshop.com',
            'email_verified_at' => new \DateTime,
            'password' => bcrypt('admin'),
            'contactNumber' => 000000000,
            'gender' => 'undefined',
            'is_admin' => 1,
        ));
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
