<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('recommended_format');
            $table->string('recommended_resolution');
            $table->string('cover_priority');
            $table->string('success_message');
            $table->string('error_message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_uploads');
    }
};
