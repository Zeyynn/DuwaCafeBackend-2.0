<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Models\Cart;
use Modules\Menu\Models\Menu;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function cartListing(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();

        return Cart::where('user_id', $user->id)->get();
    }

    public function cartDetails($id)
    {
        $user = auth()->user();
        return Cart::where('id', $id)->where('user_id', $user->id)->firstOrFail();
    }

     public function cartDropdown(Request $request)
    {
        $user = auth()->user();
        return Cart::where('user_id', $user->id)->get();
    }

    public function addToCart(Request $request) 
    {
        $user = auth()->user();
        $menu = Menu::findOrFail($request->menu_id);

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'cart_status' => 'active'],
            ['cart_id' => Str::uuid()]
        );

        $cart->items()->create([
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'price' => $menu->price,
        ]);
    }

    public function updateCartItem(Request $request, $id)
    {
        // Logic to update cart item
    }

    public function deleteCartItem($id)
    {
        // Logic to delete cart item
    }
}
