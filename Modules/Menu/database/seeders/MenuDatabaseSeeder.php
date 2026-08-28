<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Menu\Models\Menu;
use Modules\Menu\Providers\Enums\MenuStatus;
use Modules\Menu\Providers\Enums\MenuType;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            MenuType::AllDay->value => [
                ['name' => 'All-Day Breakfast Platter', 'description' => 'Eggs, sausage, hash brown, baked beans and toast.', 'price_cents' => 1890],
                ['name' => 'Chicken Chop Rice', 'description' => 'Grilled chicken chop with black pepper sauce, served with rice.', 'price_cents' => 1690],
            ],
            MenuType::Toast->value => [
                ['name' => 'Kaya Butter Toast', 'description' => 'Charcoal-grilled toast with kaya and cold butter.', 'price_cents' => 650],
                ['name' => 'French Toast with Maple Syrup', 'description' => 'Thick-cut brioche french toast, maple syrup and berries.', 'price_cents' => 1290],
            ],
            MenuType::Bites->value => [
                ['name' => 'Loaded Fries', 'description' => 'Fries topped with cheese sauce, bacon bits and spring onion.', 'price_cents' => 1490],
                ['name' => 'Crispy Chicken Wings (6pcs)', 'description' => 'Double-fried wings tossed in salted egg sauce.', 'price_cents' => 1790],
            ],
            MenuType::Pizza->value => [
                ['name' => 'Margherita Pizza', 'description' => 'San Marzano tomato, mozzarella and fresh basil.', 'price_cents' => 2490],
                ['name' => 'Pepperoni Pizza', 'description' => 'Double pepperoni with mozzarella and oregano.', 'price_cents' => 2690],
            ],
            MenuType::Pasta->value => [
                ['name' => 'Aglio Olio', 'description' => 'Spaghetti tossed in garlic, chili flakes and olive oil.', 'price_cents' => 1590],
                ['name' => 'Carbonara', 'description' => 'Fettuccine in creamy egg sauce with smoked beef and parmesan.', 'price_cents' => 1790],
            ],
            MenuType::EtCetera->value => [
                ['name' => 'Caesar Salad', 'description' => 'Romaine lettuce, grilled chicken, croutons and parmesan.', 'price_cents' => 1490],
                ['name' => 'Soft Serve Ice Cream', 'description' => 'Vanilla soft serve with chocolate drizzle.', 'price_cents' => 790],
            ],
            MenuType::Soup->value => [
                ['name' => 'Mushroom Soup', 'description' => 'Creamy button mushroom soup with garlic croutons.', 'price_cents' => 990],
                ['name' => 'Tomato Basil Soup', 'description' => 'Roasted tomato soup finished with fresh basil.', 'price_cents' => 990],
            ],
            MenuType::Espresso->value => [
                ['name' => 'Espresso', 'description' => 'Double shot of house-blend espresso.', 'price_cents' => 750],
                ['name' => 'Cappuccino', 'description' => 'Espresso with steamed milk and a thick layer of foam.', 'price_cents' => 990],
                ['name' => 'Caffe Latte', 'description' => 'Espresso with steamed milk and light foam.', 'price_cents' => 990],
            ],
            MenuType::Frappe->value => [
                ['name' => 'Caramel Frappe', 'description' => 'Blended iced coffee with caramel and whipped cream.', 'price_cents' => 1290],
                ['name' => 'Mocha Frappe', 'description' => 'Blended iced coffee with chocolate and whipped cream.', 'price_cents' => 1290],
            ],
            MenuType::NonCoffee->value => [
                ['name' => 'Iced Milo', 'description' => 'Classic chocolate malt drink, served iced.', 'price_cents' => 790],
                ['name' => 'Matcha Latte', 'description' => 'Japanese matcha with steamed milk.', 'price_cents' => 1190],
                ['name' => 'Hot Chocolate', 'description' => 'Rich Belgian chocolate with steamed milk.', 'price_cents' => 990],
            ],
        ];

        foreach ($items as $menuType => $menuItems) {
            foreach ($menuItems as $item) {
                Menu::updateOrCreate(
                    ['menu_slug' => Str::slug($item['name'])],
                    [
                        'menu_name' => $item['name'],
                        'menu_type' => $menuType,
                        'menu_description' => $item['description'],
                        'menu_price_cents' => $item['price_cents'],
                        'menu_status' => MenuStatus::ACTIVE->value,
                    ],
                );
            }
        }
    }
}
