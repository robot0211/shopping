<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use SearchProductTrait;
    private $menu;
    private $product;
    private $slider;
    public function __construct(Menu $menu, Product $product, Slider $slider)
    {
        $this->menu = $menu;
        $this->product = $product;
        $this->slider = $slider;
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);

        if(!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->feature_image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }
    }

    public function viewCart(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();
        $sliders = $this->slider->latest()->get();

        return view('shop.cart.index', compact('menusParent', 'products', 'query', 'perPage', 'category_id', 'sliders'));
    }
}
