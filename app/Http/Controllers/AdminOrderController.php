<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private $order;
    private $role;
    public function __construct(Order $order, Role $role)
    {
        $this->order = $order;
        $this->role = $role;
    }
    
    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5);
        
        $orders = $this->order->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('email', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.order.index', compact('orders', 'query', 'perPage'));
    }

    public function show($id)
    {
        $order = Order::with('orderDetails.product')->find($id);
        return view('admin.order.detail', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::find($id);
        $order->status = 'confirmed';
        $order->save();

        // Gửi email thông báo cho khách hàng
        // Mail::to($order->customer_email)->send(new \App\Mail\OrderConfirmed($order));

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xác nhận.');
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'canceled';
        $order->save();

        // Gửi email thông báo cho khách hàng
        // Mail::to($order->customer_email)->send(new \App\Mail\OrderCanceled($order));

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị hủy.');
    }
}
