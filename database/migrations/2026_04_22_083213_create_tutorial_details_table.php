<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutorial_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_tutorial_id')->constrained('master_tutorials')->onDelete('cascade');
            $table->text('text')->nullable();
            $table->string('gambar')->nullable();
            $table->longText('code')->nullable();
            $table->string('url')->nullable();
            $table->integer('order');
            $table->enum('status', ['show', 'hide'])->default('hide');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutorial_details');
    }
};