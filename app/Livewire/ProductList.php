<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ProductList extends Component
{
    public $products = [];

    public function mount()
    {
        $response = Http::get(config('app.url') . '/products');
        if ($response->successful()) {
            $this->products = $response->json();
        } else {
            dd($response->body()); // Tambahkan ini untuk debugging
        }
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
