<?php

namespace App\Actions;

use App\Models\Comment;

class CreateComment
{
    public function handle(array $data)
    {
        if (!isset($data['parent_id'])) {
            $comment = Comment::query()->create([
                'user_id' => auth('sanctum')->user()->id,
                'message' => $data['message'],
            ]);
        } else {
            $parentComment = Comment::query()->findOrFail($data['parent_id']);

            $comment = $parentComment->children()->create([
                'user_id' => auth('sanctum')->user()->id,
                'message' => $data['message'],
            ]);
        }

        if (isset($data['image'])) {
            $comment->addMedia($data['image'])->toMediaCollection('images');
        }

        if (isset($data['text_file'])) {
            $comment->addMedia($data['text_file'])->toMediaCollection('text_files');
        }

        return $comment;
    }
}
