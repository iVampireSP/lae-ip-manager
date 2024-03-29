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

            $table->string('netmask')->index();
            $table->tinyInteger('cidr')->index();

            $table->enum('type', ['ipv4', 'ipv6', 'ipv6block', 'ipv4block']);

            // gateway
            $table->string('gateway')->nullable();

            // nameservers
            $table->json('nameservers')->nullable();

            // description
            $table->string('description')->nullable();

            // pool_id
            $table->unsignedBigInteger('pool_id')->nullable()->index();

            // region_id foreign
            $table->unsignedBigInteger('region_id')->nullable()->index();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');

            $table->unsignedBigInteger('position')->index()->default(0);

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
