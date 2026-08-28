<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Cart\Models\CartMenu;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Menu extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_name',
        'menu_type',
        'menu_slug',
        'menu_description',
        'menu_price_cents',
        'menu_status',
    ];

    public function getMenuPriceAttribute(): float
    {
        return $this->menu_price_cents / 100;
    }

    public function carts()
    {
        return $this->hasMany(CartMenu::class, 'menu_id', 'menu_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('menu_image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 300, 300)
            ->nonQueued();
    }

    public function getMenuImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('menu_image') ?: null;
    }

    public function getMenuImageThumbAttribute(): ?string
    {
        return $this->getFirstMediaUrl('menu_image', 'thumb') ?: null;
    }
}
