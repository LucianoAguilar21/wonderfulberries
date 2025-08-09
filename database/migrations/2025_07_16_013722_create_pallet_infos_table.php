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
        Schema::create('pallet_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pallet_id')->constrained('pallets');
            $table->foreignId('field_id')->constrained('fields');
            $table->text('lots');
            $table->foreignId('variety_id')->constrained('varieties');
            $table->integer('number_of_boxes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pallet_infos');
    }
};
