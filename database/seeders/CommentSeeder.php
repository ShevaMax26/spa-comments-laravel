<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'user_id' => 1,
                'post_id' => 1,
                'parent_id' => null,
                'message' => 'message1',
            ],
            [
                'user_id' => 2,
                'post_id' => 1,
                'parent_id' => null,
                'message' => 'message2',
            ],
            [
                'user_id' => 3,
                'post_id' => 1,
                'parent_id' => null,
                'message' => 'message3',
            ],
            [
                'user_id' => 3,
                'post_id' => 1,
                'parent_id' => 1,
                'message' => 'message4',
            ],
            [
                'user_id' => 2,
                'post_id' => 1,
                'parent_id' => 2,
                'message' => 'message5',
            ],
            [
                'user_id' => 1,
                'post_id' => 1,
                'parent_id' => 3,
                'message' => 'message6',
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
