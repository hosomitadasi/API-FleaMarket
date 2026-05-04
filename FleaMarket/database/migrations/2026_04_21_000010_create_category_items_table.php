<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('category_items', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->unique(['item_id', 'category_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('category_items', function (Blueprint $table) {
            $table->dropForeign('category_items_item_id_foreign');
        });
        Schema::dropIfExists('category_items');
    }
};
