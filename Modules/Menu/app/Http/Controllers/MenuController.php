<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Menu\Models\Menu;
use Modules\Menu\Http\Requests\CreateMenuRequest;
use Modules\Menu\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{

    public function listing($_, array $args)
    {
        $input = $args['input'] ?? [];

        return Menu::query()
            ->when(isset($input['keyword']), function ($query) use ($input) {
                $query->where('menu_name', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('menu_type', 'like', '%' . $input['keyword'] . '%');
            })
            ->get();
    }

    public function detail($_, array $args)
    {
        return Menu::find($args['menu_id']);
    }

    public function create(CreateMenuRequest $request)
    {
        $input = $request->validated();

        try {
            $data = Menu::create([
                'menu_name' => $input['menu_name'],
                'menu_slug' => $input['menu_slug'],
                'menu_type' => $input['menu_type'],
                'menu_description' => $input['menu_description'] ?? null,
                'menu_price_cents' => $input['menu_price_cents'],
            ]);

            if (! empty($input['image'])) {
                $data->addMedia($input['image'])->toMediaCollection('menu_image');
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

        return [
            'status' => true,
            'message' => 'Menu created successfully',
            'data' => $data
        ];
    }

    public function update(UpdateMenuRequest $request)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            $data = Menu::find($input['menu_id']);
            if (!$data) {
                throw new \Exception('Menu not found');
            }

            $data->update(collect($input)->except(['menu_id', 'image'])->all());

            if (! empty($input['image'])) {
                $data->addMedia($input['image'])->toMediaCollection('menu_image');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'status' => true,
            'message' => 'Menu updated successfully',
            'data' => $data
        ];
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Menu::find($request->menu_id);
            if (!$data) {
                throw new \Exception('Menu not found');
            }
            $data->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return [
            'status' => true,
            'message' => 'Menu deleted successfully'
        ];
    }
}
