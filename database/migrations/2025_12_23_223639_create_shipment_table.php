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
        Schema::create('shipment', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->boolean('delivered')->default(false);

            $table->text('sender_name');
            $table->text('sender_city');
            $table->text('sender_country');

            $table->text('receiver_name');
            $table->text('receiver_city');
            $table->text('receiver_country');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippables');
    }
};
