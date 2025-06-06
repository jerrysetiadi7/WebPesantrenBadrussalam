<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('image_url');
            $table->timestamps(); // <--- ini penting untuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
