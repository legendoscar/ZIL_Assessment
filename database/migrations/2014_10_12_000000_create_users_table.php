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
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->enum('prefixname', ['Mr', 'Mrs', 'Ms'])->nullable();
            $table->string('firstname')->default(NULL);
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffixname')->nullable();            
            $table->string('username')->unique()->default(NULL);
            $table->string('email')->unique()->default(NULL);
            $table->text('password');
            $table->text('photo')->nullable();
            $table->string('type')->default('user')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->index('type');
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
