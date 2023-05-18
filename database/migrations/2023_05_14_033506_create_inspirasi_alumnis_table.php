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
        Schema::create('inspirasi_alumnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug');
            $table->text('excerpt');
            $table->longText('body');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspirasi_alumnis');
    }
};
