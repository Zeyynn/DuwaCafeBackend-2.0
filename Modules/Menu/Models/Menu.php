<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_name',
        'menu_slug',
        'menu_description',
        'menu_price_cents',
        'menu_image',
    ];

    public function getMenuPriceAttribute(): float
    {
        return $this->menu_price_cents / 100;
    }
}
