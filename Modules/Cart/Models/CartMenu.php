<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;

class CartMenu extends Model
{
    protected $table = 'cart_menu';

    protected $fillable = [
        'cart_id',
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

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }
}
