<?php

namespace Modules\Cart\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Cart\Http\Controllers\CartController;
use App\GraphQL\Mutations\Mutator;

class CartQuery extends Mutator
{
    protected $controller = CartController::class;

    public function cartListing($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
    
    public function cartDetails($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function cartDropdown($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
}