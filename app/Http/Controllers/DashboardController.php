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
                'total_apostado' => $user->bets()->sum('valor_apostado'),
                'total_recebido' => $user->bets()->sum('valor_retorno'),
                'prejuizo' => $user->bets()->sum('valor_apostado') - $user->bets()->sum('valor_retorno'),
            ];

            return Inertia::render('Dashboard', [
                'auth' => ['user' => $user],
                'stats' => $stats,
            ]);
        }

        // Dados globais fictícios para usuários deslogados
        $dadosGlobais = [
            'perdas_mundiais' => 'US$ 500 bilhões/ano',
            'vicio_estatistica' => '1 em cada 5 jovens se torna dependente',
            'suicidios_relacionados' => 'Mais de 2000/ano globalmente',
        ];

        return Inertia::render('Dashboard', [
            'auth' => ['user' => null],
            'globais' => $dadosGlobais,
        ]);
    }
}
