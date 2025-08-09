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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->constrained('clients');

            $table->foreignId('destination_id')->constrained('destinations');
            $table->foreignId('exporter_id')->constrained('exporters');
            
            $table->enum('transport', ['air', 'sea', 'land'])->default('air');
            
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->boolean('organic')->default(false);
            $table->text('observations')->nullable();
            $table->string('pot_size');
            $table->integer('total_pallets')->default(0);
            
            $table->boolean('is_labeled')->default(false);
            $table->string('label')->nullable();

            $table->enum('treatment', ['Frio', 'Brom'])->default('Frio');

            $table->string('box_type');

            $table->date('end_date')->nullable();

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
