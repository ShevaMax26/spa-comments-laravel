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
        $image = $this->getMedia('images')->first();
        $textFile = $this->getMedia('text_files')->first();

        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'parent_id' => $this->parent->id ?? $this->parent,
            'message' => $this->message,
            'image' => $image ? $image->getUrl() : null,
            'text_file' => $textFile ? $textFile->getUrl() : null,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.y в H:i'),
        ];
    }
}
