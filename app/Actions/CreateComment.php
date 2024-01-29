<?php

namespace App\Actions;

use App\Models\Comment;

class CreateComment
{
    public function handle(array $data)
    {
        if (!isset($data['parent_id'])) {
            return Comment::query()->create([
                'user_id' => auth('sanctum')->user()->id,
                'message' => $data['message'],
            ]);
        }
        else {
            $parentComment  = Comment::query()->findOrFail($data['parent_id']);

            return $parentComment->children()->create([
                'user_id' => auth('sanctum')->user()->id,
                'message' => $data['message'],
            ]);
        }
    }
}
