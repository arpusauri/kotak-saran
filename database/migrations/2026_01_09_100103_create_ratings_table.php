<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suggestion_id');
            $table->integer('rating')->comment('Rating from 1-5');
            $table->text('comment')->nullable();
            $table->string('rated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
            $table->unique(['suggestion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

?>