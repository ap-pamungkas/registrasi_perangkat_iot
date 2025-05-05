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
        Schema::create('perangkat', function (Blueprint $table) {
            $table->string('id')->primary(); // ID dari ESP8266
            $table->string('no_referensi')->nullable();
            $table->enum('status', ['aktif', 'tidak aktif'])->default('tidak aktif');
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat');
    }
};
