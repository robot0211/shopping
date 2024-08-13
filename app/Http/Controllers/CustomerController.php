<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Product;
use App\Traits\SearchProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    use SearchProductTrait;
    private $menu;
    private $product;
    public function __construct(Menu $menu, Product $product)
    {
        $this->menu = $menu;
        $this->product = $product;
    }

    public function info(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 9);
        $category_id = $request->input('category_id');
        $products = $this->searchProducts($request, $query, $perPage, $category_id);
        $menusParent = $this->menu->where('parent_id', 0)->get();

        return view('shop.user.info', compact('menusParent', 'products', 'query', 'perPage', 'category_id'));
    }

    public function showLoginForm()
    {

        return view('shop.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('cus')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.'
        ])->onlyInput('email');
    }

    public function logoutCustomer(Request $request)
    {
        Auth::guard('cus')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }


    public function showRegisterForm()
    {
        return view('shop.auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20', // Cho phép trường 'phone' là null hoặc chuỗi
            'address' => 'nullable|string|max:255', // Cho phép trường 'address' là null hoặc chuỗi
        ], [
            'last_name.required' => 'Vui lòng nhập tên của bạn.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',
        ]);

        try {
            DB::beginTransaction();

            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            DB::commit();

            return redirect()->route('customer.register')->with('success', 'Đăng ký thành công!'); // Thông báo thành công và không yêu cầu đăng nhập lại
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error creating account: ' . $exception->getMessage());
            return back()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo tài khoản của bạn. Vui lòng thử lại.']);
        }
    }
}
