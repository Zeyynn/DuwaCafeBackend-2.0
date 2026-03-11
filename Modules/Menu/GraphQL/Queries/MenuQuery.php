<?php

namespace Modules\Menu\GraphQL\Queries;

use Modules\Menu\Models\Menu;

class MenuQuery
{
    public function menuListing($root ,array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@listing', [request()->merge($args + ['action' => 'index'])]);
    }

    public function menuDetails($root, array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@details', [request()->merge($args + ['action' => 'show'])]);
    }
}