<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suggestion_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->text('description')->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
            
            $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};

?>