<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Models\Cart;

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
        // Logic to add item to cart
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
