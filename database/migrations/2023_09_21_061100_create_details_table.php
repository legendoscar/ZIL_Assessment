<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->text('key');
            $table->text('value')->nullable();
            $table->text('icon')->nullable();
            $table->string('status')->default('1');
            $table->string('type')->default('detail')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();



            $table->timestamps();

            $table->index('key');
            $table->index('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
