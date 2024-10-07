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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string("plan_id");
            $table->string("name");
            $table->string("slug");
            $table->string("currency");
            $table->string("billing_method");
            $table->string("billing_period");
            $table->string("price");
            $table->string("status");
            $table->string("image")->nullable();
            $table->string("added_from");
            $table->longText("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
