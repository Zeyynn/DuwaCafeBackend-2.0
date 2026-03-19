<?php

namespace Modules\Cart\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Cart\Http\Controllers\CartController;
use App\GraphQL\Mutations\Mutator;

class CartMutator extends Mutator
{
    protected $controller = CartController::class;

    public function addToCart($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
    
    public function updateCartItem($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function removeFromCart($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
}