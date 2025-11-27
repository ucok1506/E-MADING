<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_approvals', function (Blueprint $table) {
            $table->id('id_approval');
            $table->unsignedBigInteger('id_artikel');
            $table->unsignedBigInteger('id_user'); // user yang submit
            $table->unsignedBigInteger('id_admin')->nullable(); // admin yang approve/reject
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamp('tanggal_submit');
            $table->timestamp('tanggal_review')->nullable();
            $table->timestamps();

            $table->foreign('id_artikel')->references('id_artikel')->on('artikel')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_approvals');
    }
};