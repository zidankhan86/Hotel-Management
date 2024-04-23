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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('area');
            $table->string('price');
            $table->string('quantity')->nullable();
            $table->string('available')->nullable();
            $table->string('adult');
            $table->string('children');
            $table->longText('description');
            $table->string('image')->nullable();
            $table->boolean('status');
            $table->foreignId('branch_id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
