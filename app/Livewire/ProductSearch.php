<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductSearch extends Component
{
    public $name = '';
    public $min_price = '';
    public $max_price = '';

    public function render()
    {
        $query = Product::where('user_id', '!=', Auth::id());

        if (!empty($this->name)) {
            $query->where('product_name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->min_price)) {
            $query->where('price', '>=', $this->min_price);
        }
        if (!empty($this->max_price)) {
            $query->where('price', '<=', $this->max_price);
        }

        return view('livewire.product-search', [
            'products' => $query->orderBy('id', 'asc')->get(),
        ]);
    }
}