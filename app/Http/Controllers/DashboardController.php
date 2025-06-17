<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $stats = [
                'bet_value' => $user->bets()->sum('bet_value'),
                'value_received' => $user->bets()->sum('value_received'),
                'loss' => $user->bets()->sum('bet_value') - $user->bets()->sum('value_received'),
            ];

            return Inertia::render('Dashboard', [
                'auth' => ['user' => $user],
                'stats' => $stats,
            ]);
        }

        // Dados globais fictícios para usuários deslogados
        $dadosGlobais = [
            'global_losses' => 'US$ 500 bilhões/ano',
            'addiction_statistics' => '1 em cada 5 jovens se torna dependente',
            'related_suicides' => 'Mais de 2000/ano globalmente',
        ];

        return Inertia::render('Dashboard', [
            'auth' => ['user' => null],
            'globais' => $dadosGlobais,
        ]);
    }
}
