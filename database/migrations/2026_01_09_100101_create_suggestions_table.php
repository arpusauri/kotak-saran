<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('category', ['feedback', 'complaint', 'suggestion', 'praise', 'other'])->default('suggestion');
            $table->text('message');
            $table->text('response')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};

?>