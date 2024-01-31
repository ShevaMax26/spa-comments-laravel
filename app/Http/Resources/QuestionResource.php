<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Question */
class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $image = $this->getMedia('images')->first();
        $textFile = $this->getMedia('text_files')->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $image ? $image->getFullUrl('thumb') : null,
            'text_file' => $textFile ? $textFile->getUrl() : null,
            'comments_count' => (int)$this->comments_count,
            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('parentComments')),
            'created_at' => Carbon::parse($this->created_at)->format('d.m.y в H:i'),
        ];
    }
}
