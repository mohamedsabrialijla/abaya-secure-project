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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pne')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->string('avatar')->nullable();
            $table->string('activation_code', 4)->nullable();
            $table->string('token', 255)->nullable();
            $table->timestamp('last_login')->useCurrent();
            $table->integer('see_notifications')->nullable()->default(1);
            $table->float('lat', 10, 0)->nullable()->default(0);
            $table->float('lng', 10, 0)->nullable()->default(0);
            $table->string('device_name')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_key', 255)->nullable();
            $table->timestamp('expiration_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
