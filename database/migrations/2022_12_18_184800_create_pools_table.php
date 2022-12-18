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
        Schema::create('pools', function (Blueprint $table) {
            $table->id();

            $table->string('pool')->index();

            $table->tinyInteger('mask')->index();

            $table->enum('type', ['ipv4', 'ipv6', 'ipv6block', 'ipv4block']);

            // price
            $table->decimal('price', 10, 2)->nullable();

            // gateway
            $table->string('gateway')->nullable();

            // nameservers
            $table->json('nameservers')->nullable();

            // description
            $table->string('description')->nullable();

            // pool_id
            $table->unsignedBigInteger('pool_id')->nullable()->index();


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
        Schema::dropIfExists('pools');
    }
};
