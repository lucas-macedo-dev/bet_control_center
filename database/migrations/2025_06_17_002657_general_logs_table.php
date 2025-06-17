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
        Schema::create('general_logs', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->string('method');
            $table->string('url');
            $table->json('request_body')->nullable();
            $table->json('response_body')->nullable();
            $table->enum('status', ['P', 'S', 'F'])->default('P')->comment('P = PENDING / S = SUCCESS / F = FAILED');
            $table->integer('http_status')->nullable();
            $table->timestamps(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_logs');
    }
};
