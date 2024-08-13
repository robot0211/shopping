<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request){
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5);

        $menus = $this->menu->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.menus.index', compact('menus', 'query', 'perPage'));
    }

    public function create(){
        $optionSelect = $this->getMenu($parentId='');

        return view('admin.menus.add', compact('optionSelect'));
    }

    public function store(Request $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
            'url' => $request->url
        ]);

        return redirect()->route('menus.index');
    }

    public function getMenu($parentId, $excludeId=null){
        $data = $this->menu->all();

        if ($excludeId !== null) {
            $data = $data->filter(function($item) use ($excludeId) {
                return $item->id != $excludeId;
            });
        }

        $recusive = new MenuRecusive($data);
        $htmlOption = $recusive->menuRecusive($parentId);
        return $htmlOption;
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $optionSelect = $this->getMenu($menu->parent_id, $menu->id);


        return view('admin.menus.edit', compact('menu', 'optionSelect'));
    }

    public function update($id, Request $request){
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
            'url' => $request->url
        ]);

        return redirect()->route('menus.index');
    }

    public function delete($id){
        $this->menu->find($id)->delete();

        return redirect()->route('menus.index');
    }
}
