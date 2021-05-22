<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('name_ar');

            $table->unsignedMediumInteger('daira_id')->nullable()->index();
            $table->foreign('daira_id')
                ->references('id')
                ->on('dairas')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communes');
    }
}
