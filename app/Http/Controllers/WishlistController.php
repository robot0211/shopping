<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use SearchProductTrait;
    private $menu;
    private $product;
    public function __construct(Menu $menu, Product $product)
    {
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();

        return view('shop.wishlist.index', compact('menusParent', 'products', 'query', 'perPage', 'category_id'));
    }
}
