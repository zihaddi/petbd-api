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
        Schema::create('compliance_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('compliance_id')->nullable();
            $table->string('details')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('compliance_id')->references('id')->on('compliances')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compliance_details');
    }
};
