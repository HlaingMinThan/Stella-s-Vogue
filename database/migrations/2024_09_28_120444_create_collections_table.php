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
            $table->string("name");
            $table->decimal("fabric")->default(0);
            $table->decimal("under")->default(0);
            $table->decimal("sample_pattern")->default(0);
            $table->decimal("sew_fees")->default(0);
            $table->decimal("model_fees")->default(0);
            $table->decimal("model_deli_fees")->default(0);
            $table->decimal("boosting")->default(0);
            $table->decimal("phone_bill")->default(0);
            $table->decimal("packing_fees")->default(0);
            $table->decimal("extra_charges")->default(0);
            $table->decimal("taxi_charges")->default(0);
            $table->decimal("ga__vlog_charges")->default(0);
            // $table->integer("stock")->default(0);
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
