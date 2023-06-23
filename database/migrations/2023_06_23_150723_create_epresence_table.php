<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('epresence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->enum('type', ['IN', 'OUT']);
            $table->boolean('is_approve')->default(false);
            $table->dateTime('waktu');

            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epresence');
    }
};
