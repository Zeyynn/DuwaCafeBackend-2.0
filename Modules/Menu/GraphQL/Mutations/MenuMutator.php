<?php

namespace Modules\Menu\GraphQL\Mutations;

use Modules\Menu\Models\Menu;
use App\GraphQL\Mutations\Mutator;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Menu\Http\Controllers\MenuController;

class MenuMutator extends Mutator

{
    protected $controller = MenuController::class;

    public function create($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function update($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function delete($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
}