<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => $this->getProducts()
        ]);
    }

    private function getProducts(): array
    {
        return [
            ['id' => 1, 'name' => 'Mouse', 'description' => 'Mouse sem fio'],
            ['id' => 2, 'name' => 'Teclado', 'description' => 'Teclado mecânico RGB'],
            // ['id' => 3, 'name' => 'Monitor', 'description' => 'Monitor 4K de 27 polegadas'],
            // ['id' => 4, 'name' => 'Notebook', 'description' => 'Notebook gamer com placa de vídeo dedicada'],
            // ['id' => 5, 'name' => 'Impressora', 'description' => 'Impressora multifuncional a laser']
        ];
    }

    public function reserve(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|min:3|max:50',
            'email' => 'required|email'
        ]);

        // $validated

        return redirect()->back()->with('success', 'Formulário enviado com sucesso!');
    }
}
