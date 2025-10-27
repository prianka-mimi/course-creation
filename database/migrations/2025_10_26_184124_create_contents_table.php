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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->index();
            $table->string('title')->nullable()->index();
            $table->string('type')->nullable();
            $table->string('video_source_type')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_length')->nullable();
            $table->text('content_text')->nullable();
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->tinyInteger('status')->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
