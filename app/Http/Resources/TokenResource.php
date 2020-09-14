<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'access_token' => $this->plainTextToken,
            'type' => 'Bearer',
            'expired_at' => config('sanctum.expiration') ? Carbon::now()->addMinutes(config('sanctum.expiration'))->toDateTimeString() : null
        ];
    }
}
