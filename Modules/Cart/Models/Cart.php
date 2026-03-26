<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Models\Menu;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'cart_id',
        'cart_status',
    ];
}
