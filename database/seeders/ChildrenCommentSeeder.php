<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildrenCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentComments = Comment::all();
        $users = User::all();

        foreach($parentComments as $comment) {
            $number = rand(1,5);

            foreach($users->random($number) as $user) {
                $childComment = Comment::factory([
                    'user_id' => $user->id,
                    'parent_id' => $comment->id,
                ])->create();

                if ($childComment->id % 2 === 0) {
                    Comment::factory([
                        'user_id' => $comment->user_id,
                        'parent_id' => $childComment->id,
                    ])->create();
                }
            }
        }
    }
}
