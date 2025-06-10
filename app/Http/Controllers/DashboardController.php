<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $stats = [
                'total_apostado' => $user->bets()->sum('valor_apostado'),
                'total_recebido' => $user->bets()->sum('valor_retorno'),
            ];
            return Inertia::render('Dashboard', compact('stats'));
        }

        return Inertia::render('Dashboard');
    }
}
