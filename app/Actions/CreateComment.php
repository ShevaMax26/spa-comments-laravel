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

            $childrenComment = $parentComment->children()->create([
                'user_id' => auth('sanctum')->user()->id,
                'message' => $data['message'],
            ]);

            if (isset($data['image'])) {
                $childrenComment->addMedia($data['image'])->toMediaCollection('images');
            }
            if (isset($data['text_file'])) {
                $childrenComment->addMedia($data['text_file'])->toMediaCollection('text_files');
            }

            return $childrenComment;
        }
    }
}
