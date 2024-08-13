<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;

class HomeProductController extends Controller
{
    use SearchProductTrait;
    private $menu;
    private $category;
    private $product;
    public function __construct(Menu $menu, Category $category, Product $product)
    {
        $this->menu  = $menu;
        $this->category = $category;
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');

        $menusParent = $this->menu->where('parent_id', 0)->get();

        $categories = $this->category->where('parent_id', 0)->get();

        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $products->appends(['query' => $query, 'perPage' => $perPage, 'category_id' => $category_id]);

        return view('shop.product.index', compact('menusParent', 'categories', 'products', 'query', 'perPage'));
    }

    public function productDetail(Request $request, $product_id)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);

        $categories = $this->category->where('parent_id', 0)->get();
        $menusParent = $this->menu->where('parent_id', 0)->get();

        $featureProducts = $this->product->latest()->take(6)->get();

        $product = $this->product->find($product_id);
        $similarProducts = $this->product->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Loại trừ sản phẩm hiện tại
            ->inRandomOrder() // Lấy ngẫu nhiên
            ->take(4) // Lấy tối đa 4 sản phẩm
            ->get();

        return view('shop.product.detail', compact('product', 'categories', 'menusParent', 'featureProducts', 'products', 'query', 'perPage', 'similarProducts'));
    }
}
