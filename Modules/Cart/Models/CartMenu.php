<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Models\Menu;

class CartMenu extends Model
{
    protected $table = 'cart_menu';

    protected $fillable = [
        'cart_id',
        'menu_id',
        'quantity',
        'price_cents',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function getUserAttribute()
    {
        return $this->cart->user;
    }

    public function getTotalPriceAttribute(): float
    {
        return $this->quantity * ($this->price_cents / 100);
    }
}
