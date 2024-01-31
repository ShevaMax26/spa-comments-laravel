<?php

namespace App\Actions;

use App\Models\User;

class CreateComment
{
    public function handle(array $data, User $user)
    {
        $data['user_id'] = $user->id;

        $comment = $user->comments()->create($data);

        if (isset($data['image'])) {
            $comment->addMedia($data['image'])->toMediaCollection('images');
        }

        if (isset($data['text_file'])) {
            $comment->addMedia($data['text_file'])->toMediaCollection('text_files');
        }

        return $comment;
    }
}
