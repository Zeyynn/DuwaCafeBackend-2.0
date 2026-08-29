<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Cart\Http\Requests\AddToCartRequest;
use Modules\Cart\Http\Requests\RemoveFromCartRequest;
use Modules\Cart\Http\Requests\UpdateCartItemRequest;
use Modules\Cart\Models\Cart;
use Modules\Cart\Providers\OrderStatus;
use Modules\Menu\Models\Menu;
use Modules\User\Models\User;

class CartController extends Controller
{
    public function cartListing()
    {
        $cart = $this->activeCart($this->authenticatedUser());

        return $cart->items()->with('menu')->get();
    }

    public function cartDetails(Request $request)
    {
        $cart = $this->activeCart($this->authenticatedUser());

        return $cart->items()
            ->with('menu')
            ->where('cart_menu.id', $request->cartId)
            ->firstOrFail();
    }

    public function addToCart(AddToCartRequest $request)
    {
        $data = $request->validated();

        $user = $this->authenticatedUser();
        $menu = Menu::findOrFail($data['menu_id']);
        $cart = $this->activeCart($user);

        $item = $cart->items()->where('menu_id', $menu->menu_id)->first();

        if ($item) {
            $item->increment('quantity', $data['quantity']);
        } else {
            $cart->items()->create([
                'menu_id' => $menu->menu_id,
                'quantity' => $data['quantity'],
                'price_cents' => $menu->menu_price_cents,
            ]);
        }

        return [
            'status' => true,
            'message' => 'Item added to cart.',
            'data' => $cart
        ];
    }

    public function updateCartItem(UpdateCartItemRequest $request)
    {
        $data = $request->validated();

        $cart = $this->activeCart($this->authenticatedUser());
        $item = $cart->items()->where('id', $data['id'])->firstOrFail();
        $item->update(['quantity' => $data['quantity']]);

        if ($data['quantity'] == 0) {
            $item->delete();
        }

        return [
            'status' => true,
            'message' => 'Cart item updated.',
            'data' => $cart
        ];
    }

    public function removeFromCart(RemoveFromCartRequest $request)
    {
        $data = $request->validated();

        $cart = $this->activeCart($this->authenticatedUser());
        $cart->items()->where('id', $data['id'])->delete();

        return [
            'status' => true,
            'message' => 'Item removed from cart.',
        ];
    }

    protected function authenticatedUser(): User
    {
        $user = auth()->user();

        if (! $user) {
            throw ValidationException::withMessages([
                'auth' => ['You must be logged in to manage your cart.'],
            ]);
        }

        return $user;
    }

    protected function activeCart(User $user): Cart
    {
        return Cart::firstOrCreate(
            ['user_id' => $user->id, 'cart_status' => OrderStatus::ACTIVE->value],
        );
    }
}
