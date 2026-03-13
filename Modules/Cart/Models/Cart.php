<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Models\Menu;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    public function getTotalPriceAttribute(): float
    {
        return $this->quantity * $this->menu->menu_price;
    }
}
