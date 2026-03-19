<?php

namespace Modules\Menu\GraphQL\Queries;

use Modules\Menu\Models\Menu;

class MenuQuery
{
    public function menuListing($root ,array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@listing', ['_' => null, 'args' => $args]);
    }

    public function menuDetails($root, array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@detail', ['_' => null, 'args' => $args]);
    }
}