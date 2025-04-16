<?php

use App\Models\Label;
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
        Schema::create('product_label_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->on('sgo_products')->cascadeOnDelete();
            $table->foreignIdFor(Label::class)->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'label_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_label_product');
    }
};
