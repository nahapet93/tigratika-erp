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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('position')->nullable();
            $table->integer('amount');
            $table->integer('laser')->nullable();
            $table->integer('welding')->nullable();
            $table->integer('assembly')->nullable();
            $table->integer('electricity')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('products');
            $table->foreignId('source_id')->constrained('sources');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['source_id']);
        });
        Schema::dropIfExists('products');
    }
};
