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
        Schema::create('ips', function (Blueprint $table) {
            $table->id();

            $table->string('ip')->index()->nullable();
            $table->decimal('ip_v6', 39, 0)->index()->nullable();

            // pool_id
            $table->unsignedBigInteger('pool_id')->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');


            $table->string('mac')->index()->nullable();

            $table->string('hostname')->index()->nullable();

            $table->string('description')->nullable();

            $table->decimal('price', 10, 2)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ips');
    }
};
