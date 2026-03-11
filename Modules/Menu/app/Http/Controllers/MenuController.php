<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Menu\Models\Menu;
use Modules\Menu\app\Http\Requests\CreateMenuRequest;
use Modules\Menu\app\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{

    public function listing()
    {
        return Menu::query()
            ->when(isset($args['menu_name']), function ($query) use ($args) {
                $query->where('menu_name', 'like', '%' . $args['menu_name'] . '%');
            })
            ->get();
    }

    public function show($id, array $args)
    {
        return Menu::find($args['menu_id']);
    }

    public function create(CreateMenuRequest $request)
    {
        $menu = Menu::create($request->validated());
        return [
            'status' => true,
            'message' => 'Menu created successfully',
            'data' => $menu
        ];
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return[
                'status' => false,
                'message' => 'Menu not found'
            ];  
        }
        $menu->update($request->validated());
        return [
            'status' => true,
            'message' => 'Menu updated successfully',
            'data' => $menu
        ];
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return [
                'status' => false,
                'message' => 'Menu not found'
            ];
        }
        $menu->delete();
        return [
            'status' => true,
            'message' => 'Menu deleted successfully'
        ];
    }

}
