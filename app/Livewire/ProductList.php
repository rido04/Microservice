<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ProductList extends Component
{
    public $products = [];

    public function mount()
    {
        $response = Http::get(config('app.url') . '/api/products');

        if ($response->successful()) {
            $this->products = $response->json();
        } else {
            // Tambahkan debugging untuk melihat respons API
            dd($response->body());
        }
    }

    public function render()
    {
        return view('livewire.product-list', ['products' => $this->products]);
    }
}
