<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->unsignedDouble('price');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->boolean('online')->default(0);
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('products');
    }
}
