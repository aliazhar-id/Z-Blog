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
    Schema::create('posts', function (Blueprint $table) {
      $table->id('id_post');
      $table->foreignId('id_category');
      $table->foreignId('id_user');
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('excerpt');
      $table->text('body');
      $table->integer('click')->default(0);
      $table->string('image')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('posts');
  }
};
