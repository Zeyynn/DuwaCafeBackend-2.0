<?php

namespace Modules\User\GraphQL\Mutations;

use App\GraphQL\Mutations\Mutator;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\User\Http\Controllers\AuthController;

class AuthMutator extends Mutator
{
    protected $controller = AuthController::class;

    public function register($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function login($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function sendEmailVerification($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function sendPhoneVerification($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function verifyEmail($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }

    public function verifyPhone($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->resolve(__FUNCTION__, $args, $context);
    }
}
