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
        Schema::create('pallets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->onDelete('cascade');           

            $table->string('pallet_number');           
           
            
            $table->enum('score',[
                'A', 'B', 'C', 'D'
            ])->default('A');

            $table->text('traceability');


            $table->float('reds')->default(0);
            $table->float('deshidrated')->default(0);
            $table->float('sensitivas')->default(0);
            $table->float('soft')->default(0);
            $table->float('wounds')->default(0);           
            $table->float('scars')->default(0);
            $table->float('rotten')->default(0);
            $table->float('fungus')->default(0);

            $table->float('QC');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pallets');
    }
};
