<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kode_mata_kuliah');
            $table->string('nama_mata_kuliah')->nullable();
            $table->string('url_presentation')->unique();
            $table->string('url_finished')->unique();
            $table->string('creator_email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_tutorials');
    }
};