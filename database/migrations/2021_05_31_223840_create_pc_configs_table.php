<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('compatible_with');
            $table->foreign('compatible_with')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete()
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
        Schema::dropIfExists('pc_configs');
    }
}
