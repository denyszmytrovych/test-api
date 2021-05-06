<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
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
            'integer' => $this->integer,
            'roman' => $this->roman,
            'count' => $this->count,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
