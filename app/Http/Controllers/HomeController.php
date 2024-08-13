<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SearchProductTrait;
    private $slider;
    private $category;
    private $menu;
    private $product;
    public function __construct(Slider $slider, Category $category, Menu $menu, Product $product)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);


        $sliders = $this->slider->latest()->get();
        $categories = $this->category->where('parent_id', 0)->get();


        $featureCategories = $this->category->withCount('products') // Lấy số lượng sản phẩm của mỗi danh mục
            ->orderBy('products_count', 'desc') // Sắp xếp theo số lượng sản phẩm giảm dần
            ->take(6) // Lấy 6 danh mục đầu tiên
            ->get();

        $menusParent = $this->menu->where('parent_id', 0)->get();

        $featureProducts = $this->product->latest()->take(6)->get();

        return view('shop.index', compact('sliders', 'categories', 'featureProducts', 'featureCategories', 'menusParent', 'products', 'query', 'perPage'));
    }

    public function contact(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();

        return view('shop.contact.contact', compact('menusParent', 'products', 'query', 'perPage'));
    }

}
