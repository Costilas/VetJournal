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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id');
            $table->foreignId('user_id');
            $table->timestamp('visit_date',6);
            $table->integer('weight')->unsigned();
            $table->integer('temperature')->unsigned();
            $table->string('pre_diagnosis', 60);
            $table->text('visit_info');
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
