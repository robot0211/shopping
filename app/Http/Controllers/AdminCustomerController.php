<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    use DeleteModelTrait;
    private $customer;
    private $role;
    public function __construct(Customer $customer, Role $role)
    {
        $this->customer = $customer;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5);
        
        $customers = $this->customer->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('email', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.customer.index', compact('customers', 'query', 'perPage'));
    }
}
