<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\Controller;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

abstract class Mutator
{
    protected $controller = Controller::class;

    public function resolve(string $function, array $args, GraphQLContext $context)
    {
        return app()->call("$this->controller@$function", [$context->request()->merge($args)]);
    }
}
