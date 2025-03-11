<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ProductList extends Component
{
    public $products = [];

    public function mount()
    {
        $api_url = env('API_URL', '/products');
        $response = Http::get($api_url);

        $this->products = $response->json();

    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
