<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
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

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('shop.checkout.index', compact('cart','menusParent', 'products', 'query', 'perPage', 'category_id', 'sliders'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $customer = Auth::guard('cus')->user();

        $order = Order::create([
            'customer_id' => $customer->id,
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_address' => $request->input('customer_address'),
            'total_price' => array_reduce($cart, function ($carry, $item) {
                return $carry + $item['price'] * $item['quantity'];
            }, 0),
            'status' => 'pending'
        ]);

        foreach ($cart as $id => $details) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('customer.orders.index')->with('success', 'Đặt hàng thành công!');
    }
}
