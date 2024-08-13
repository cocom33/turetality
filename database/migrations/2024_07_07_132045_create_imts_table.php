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
        Schema::create('imts', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('user_id')->index()->nullable();
            $table->string('name');
            $table->integer('umur');
            $table->integer('berat_badan');
            $table->integer('tinggi_badan');
            $table->integer('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imts');
    }
};