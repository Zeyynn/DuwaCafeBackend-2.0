<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Menu\Providers\Enums\MenuType;
use Modules\Menu\Providers\Enums\MenuStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->String('menu_name');
            $table->enum('menu_type', array_column(MenuType::cases(), 'value'));
            $table->String('menu_slug')->unique();
            $table->String('menu_description');
            $table->decimal('menu_price_cents');
            $table->enum('menu_status', array_column(MenuStatus::cases(), 'value'))->default(MenuStatus::INACTIVE->value);
            $table->string('menu_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
