<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class BetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'name' => $this->user->name,
            ],
            'id' => $this->id,
            'bet_value' => 'R$ ' . number_format($this->bet_value, 2, ',', '.'),
            'value_received'  => 'R$ ' . number_format($this->value_received, 2, ',', '.'),
            'created_at'     => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
