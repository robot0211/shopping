<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait SearchProductTrait
{
    public function searchProducts(Request $request, $query, $perPage = 9, $category_id)
    {
        $products = $this->product->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('price', 'like', '%' . $query . '%')
              ->orWhereHas('category', function($q) use ($query) {
                  $q->where('name', 'like', '%' . $query . '%');
              });
        })
        ->when($category_id, function ($q) use ($category_id) {
            $q->where('category_id', $category_id);
        })
        ->latest()->paginate($perPage);

        return $products;
    }
}