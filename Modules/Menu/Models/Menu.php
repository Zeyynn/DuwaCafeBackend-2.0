<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Cart\Models\Cart;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_name',
        'menu_type',
        'menu_slug',
        'menu_description',
        'menu_price_cents',
        'menu_status',
        'menu_image',
    ];

    public function getMenuPriceAttribute(): float
    {
        return $this->menu_price_cents / 100;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'menu_id', 'menu_id');
    }
}
