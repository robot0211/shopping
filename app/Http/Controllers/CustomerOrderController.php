<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
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

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();
        $sliders = $this->slider->latest()->get();

        $orders = Auth::guard('cus')->user()->orders;
        return view('shop.order.index', compact('orders', 'menusParent', 'products', 'query', 'perPage', 'category_id', 'sliders'));
    }

    public function show($id, Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();
        $sliders = $this->slider->latest()->get();

        $customer = Auth::guard('cus')->user();
        $order = Order::where('customer_id', $customer->id)
                           ->with('orderDetails.product')
                           ->find($id);

        if (!$order) {
            return redirect()->route('customer.orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        return view('shop.order.show', compact('order', 'menusParent', 'products', 'query', 'perPage', 'category_id', 'sliders'));
    }
}
