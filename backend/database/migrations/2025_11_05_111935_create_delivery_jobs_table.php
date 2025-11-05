<?php

use App\Enums\DeliveryStatus;
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
        Schema::create('delivery_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('starting_address');
            $table->text('destination_address');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->enum('status', [
                DeliveryStatus::ACCEPTED->value,
                DeliveryStatus::DISTRIBUTED->value,
                DeliveryStatus::IN_TRANSIT->value,
                DeliveryStatus::DELIVERED->value,
                DeliveryStatus::FAILED->value,
            ])->default(DeliveryStatus::ACCEPTED->value);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_jobs');
    }
};
