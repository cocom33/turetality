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
        Schema::create('analyst_chses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignUuid('user_id')->index()->nullable();
            $table->integer('number')->default(1);
            $table->boolean('check');
            $table->string('photo')->nullable();
            $table->string('place');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyst_chses');
    }
};