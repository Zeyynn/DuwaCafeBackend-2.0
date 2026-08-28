<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'user_id',
        'cart_status',
    ];

    public function items()
    {
        return $this->hasMany(CartMenu::class, 'cart_id', 'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
