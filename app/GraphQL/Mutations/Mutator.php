<?php

namespace App\GraphQL\Mutations;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\App;

abstract class Mutator
{
    protected $controller;

    protected function resolve(string $method, array $args, GraphQLContext $context): mixed
    {
        request()->merge($args);

        $params = $args;
        foreach ($args as $key => $value) {
            if (str_ends_with($key, '_id')) {
                $params['id'] = $value;
                break;
            }
        }

        $controller = App::make($this->controller);
        return app()->call([$controller, $method], $params);
    }
}