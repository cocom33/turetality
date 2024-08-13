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
        Schema::create('analyst_gizis', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('type');
            $table->foreignUuid('user_id')->index()->nullable();
            $table->string('menu');
            $table->string('asal');
            $table->string('photo');
            $table->timestamp('date');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyst_gizis');
    }
};
