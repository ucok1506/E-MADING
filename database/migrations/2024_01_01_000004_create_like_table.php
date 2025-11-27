<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('like', function (Blueprint $table) {
            $table->id('id_like');
            $table->foreignId('id_artikel')->constrained('artikel', 'id_artikel')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('like');
    }
};