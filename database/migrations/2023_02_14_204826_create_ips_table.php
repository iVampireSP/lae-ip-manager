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
    public function up(): void
    {
        // drop table ips
        Schema::dropIfExists('ips');

        Schema::create('ips', function (Blueprint $table) {
            $table->id();

            $table->string('ip')->index()->nullable();

            // $table->string('netmask')->index()->nullable();
            // $table->unsignedBigInteger('cidr')->index()->nullable();

            // $table->enum('type', ['ipv4', 'ipv6', 'ipv6block', 'ipv4block']);

            // pool_id
            $table->unsignedBigInteger('pool_id')->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');


            $table->string('mac')->index()->nullable();

            $table->string('hostname')->index()->nullable();

            $table->string('description')->nullable();

            $table->boolean('blocked')->default(false)->index();

            $table->string('module_id')->index()->nullable();
            $table->unsignedBigInteger('host_id')->index()->nullable();

            // position
            $table->unsignedBigInteger('position')->index();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('ips');
    }
};
