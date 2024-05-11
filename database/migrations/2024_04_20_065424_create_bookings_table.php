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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->integer('total_rooms');
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('checking_status')->default(false);
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->text('note')->nullable();
            $table->string('transaction_id');
            $table->string('currency');
            $table->string('price');
            $table->string('branch_name');
            $table->string('email');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
