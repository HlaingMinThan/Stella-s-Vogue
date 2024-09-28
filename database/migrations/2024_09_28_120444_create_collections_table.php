<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->integer("fabric");
            $table->integer("under");
            $table->integer("sample_pattern");
            $table->integer("sew_fees");
            $table->integer("model_fees");
            $table->integer("model_deli_fees");
            $table->integer("boosting");
            $table->integer("phone_bill");
            $table->integer("packing_fees");
            $table->integer("extra_charges");
            $table->integer("taxi_charges");
            $table->integer("ga__vlog_charges");
            $table->integer("stock");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
