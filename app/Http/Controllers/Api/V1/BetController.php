<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BetRequest;
use App\Http\Resources\BetResource;
use App\Models\Bet;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Services\BetService;
use Illuminate\Routing\Controller;

class BetController extends Controller
{
    protected BetService $betService;
    public function __construct(BetService $betService)
    {
        $this->betService = $betService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bets = Bet::with('user')
            ->where('user_id', '=', auth()->user()->id)
            ->get();
        return Inertia::render('Bets/List', ['bets' => BetResource::collection($bets)->resolve()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Bets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BetRequest $request)
    {
        $validated = $request->validated();

        if ($request->user()->bets()->create($validated)) {
            return redirect()->route('dashboard')->with('success', 'Aposta cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao cadastrar a aposta.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($id) {
            $bets = Bet::where('id', '=', $id)->toArray();
        }

        return Inertia::render('Bets/List', ['bets' => new BetResource($bets) ?? []]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
