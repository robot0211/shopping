<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create(){
        $htmlOption = $this->getCategory($parentId='');

        return view('admin.category.add', compact('htmlOption'));
    }

    public function index(Request $request){
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5);

        $categories = $this->category->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.category.index', compact('categories', 'query', 'perPage'));
    }

    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    public function getCategory($parentId, $excludeId=null){
        $data = $this->category->all();

        if ($excludeId !== null) {
            $data = $data->filter(function($item) use ($excludeId) {
                return $item->id != $excludeId;
            });
        }

        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id, $category->id);


        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request){
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    public function delete($id){
        $this->category->find($id)->delete();

        return redirect()->route('categories.index');
    }
}
