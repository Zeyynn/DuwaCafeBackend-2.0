<?php

namespace Modules\User\GraphQL\Mutations;

use Modules\User\Models\User;
use App\GraphQL\Mutations\Mutator;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\User\Http\Controllers\UserController;

class UserMutator extends Mutator

{
    protected $controller = UserController::class;

    public function register($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function login($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
}