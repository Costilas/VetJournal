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
        Schema::table('owners', function (Blueprint $table) {
            $table->string('phone', 11)->nullable()->change();
            $table->string('email', 50)->nullable()->default(null);
            $table->string('additional_phone', 20)->nullable()->default(null)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('additional_phone');
            $table->string('phone', 11)->nullable(false)->change();
        });
    }
};
