<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pet_id');
            $table->unsignedInteger('groomer_profile_id');
            $table->unsignedInteger('service_id');
            $table->datetime('scheduled_datetime');
            $table->integer('duration_minutes');
            $table->enum('location_type', ['in_house', 'at_organization']);
            $table->enum('status', ['scheduled', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show'])->default('scheduled');

            // Cost snapshot at booking time
            $table->decimal('base_cost', 10, 2);
            $table->decimal('additional_fees', 10, 2)->default(0.00);
            $table->decimal('total_cost', 10, 2);

            // Additional information
            $table->text('customer_notes')->nullable();
            $table->text('groomer_notes')->nullable();
            $table->text('cancellation_reason')->nullable();

            // Timestamps
            $table->timestamp('booked_at')->useCurrent();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('groomer_profile_id')->references('id')->on('groomer_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('modified_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->index(['pet_id', 'status']);
            $table->index(['groomer_profile_id', 'scheduled_datetime']);
            $table->index(['scheduled_datetime', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
