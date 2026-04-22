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
        if (Schema::hasTable('properties')) {
            return;
        }

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('image');
            $table->string('badge');
            $table->string('price');
            $table->text('summary');
            $table->text('description');
            $table->json('tags');
            $table->json('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is now a compatibility no-op for databases where the
        // original properties table was already created by an earlier migration.
        // Dropping the table here would incorrectly remove the canonical table
        // during rollback of later batches.
        return;
    }
};
