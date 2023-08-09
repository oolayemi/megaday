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
        Schema::create('deals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('super_deal_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('selected_ads')->nullable();
            $table->integer('auto_renewal')->nullable();
            $table->string('visibility')->default(true);
            $table->boolean('notifications')->default(true);
            $table->boolean('promotions')->default(true);
            $table->boolean('consultations')->default(true);
            $table->boolean('reports')->default(true);
            $table->boolean('feedbacks')->default(true);
            $table->timestamps();

            $table->unique(['super_deal_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
