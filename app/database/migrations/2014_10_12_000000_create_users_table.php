<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 50);
            $table->string('patronymic', 50);
            $table->string('name', 50);
            $table->string('email', 70)->unique();
            $table->string('password');
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->tinyInteger('is_admin')->unsigned()->default(0);
            $table->tinyInteger('is_dev')->unsigned()->default(0);
            $table->timestamps(6);
            $table->timestamp('email_verified_at', 6)->nullable();
            $table->rememberToken();
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
};
