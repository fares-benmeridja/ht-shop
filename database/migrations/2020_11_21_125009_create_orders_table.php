<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->text('address');
            $table->char('zip_code', 5);
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedSmallInteger('commune_id')->nullable()->index();
            $table->foreign('commune_id')
                ->references('id')
                ->on('communes')
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
        Schema::dropIfExists('orders');
    }
}
