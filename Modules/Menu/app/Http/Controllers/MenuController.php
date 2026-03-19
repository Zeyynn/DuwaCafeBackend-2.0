<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Menu\Models\Menu;
use Modules\Menu\Http\Requests\CreateMenuRequest;
use Modules\Menu\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{

    public function listing($_, array $args)
    {   
        $input = $args['input'] ?? [];
        
        return Menu::query()
            ->when(isset($args['keyword']), function ($query) use ($input) {
                $query->where('menu_name', 'like', '%' . $input['keyword'] . '%');
            })
            ->get();
    }

    public function detail($_, array $args)
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
