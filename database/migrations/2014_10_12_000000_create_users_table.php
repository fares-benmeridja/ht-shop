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
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
//            $table->string('slug', 100)->unique();
            $table->text('address');
            $table->string('phone');
            $table->string('facebook')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedTinyInteger('role_id')->nullable()->index();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('users');
    }
}
