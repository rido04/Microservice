<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ProductList extends Component
{
    public $products = [];

    public function mount()
    {
        $response = Http::timeout(60)->get(config('app.url') . '/api/products');

        if ($response->successful()) {
            $this->products = $response->json();
        }
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
