<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BetController extends Controller
{
    public function create()
    {
        return Inertia::render('Bets/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'valor_apostado' => 'required|numeric|min:0',
            'valor_retorno' => 'required|numeric|min:0',
            'descricao' => 'nullable|string|max:255',
        ]);

        $request->user()->bets()->create($data);

        return redirect()->route('dashboard')->with('success', 'Aposta cadastrada com sucesso!');
    }
}
