<?php

use App\Static\PaymentOption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->enum('payment', PaymentOption::all());
            $table->string('screenshot')->nullable();
            $table->string('color');
            $table->unsignedBigInteger('delivery_id');
            $table->text('notes')->nullable();
            $table->decimal('amount', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
