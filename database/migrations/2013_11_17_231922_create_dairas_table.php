<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDairasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dairas', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name');
            $table->string('name_ar');

            $table->unsignedTinyInteger('wilaya_id')->index()->nullable();
            $table->foreign('wilaya_id')
                ->on('wilayas')
                ->references('id')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dairas');
    }
}
