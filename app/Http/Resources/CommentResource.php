<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => new UserResource($this->user),
            'parent_id' => $this->parent,
            'message' => $this->message,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.y в H:i'),
        ];
    }
}
