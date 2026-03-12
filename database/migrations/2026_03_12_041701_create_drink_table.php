<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Menu\Providers\Enums\DrinkType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drink', function (Blueprint $table) {
            $table->id('drink_id');
            $table->String('drink_name');
            $table->enum('drink_type', array_column(DrinkType::cases(), 'value'));
            $table->String('drink_slug')->unique();
            $table->String('drink_description');
            $table->decimal('drink_price_cents');
            $table->string('drink_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink');
    }
};
