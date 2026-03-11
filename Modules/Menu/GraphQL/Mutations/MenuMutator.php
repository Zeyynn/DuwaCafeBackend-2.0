<?php

namespace Modules\Menu\GraphQL\Mutations;

use Modules\Menu\Models\Menu;

class MenuMutator

{
    public function createMenu($root, array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@create', [request()->merge($args + ['action' => 'create'])]);
    }
    public function updateMenu($root, array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@update', [request()->merge($args + ['action' => 'update'])]);
    }
    public function deleteMenu($root, array $args)
    {
        return app()->call('Modules\Menu\Http\Controllers\MenuController@delete', [request()->merge($args + ['action' => 'delete'])]);
    }
}