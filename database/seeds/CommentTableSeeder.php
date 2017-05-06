<?php

use App\Comment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $comments = array(
            ['user_id' => 2, 'author' => 'Chris Sevilleja', 'text' => 'Look I am a test comment.'],
            ['user_id' => 2, 'author' => 'Nick Cerminara', 'text' => 'This is going to be super crazy.'],
            ['user_id' => 2, 'author' => 'Holly Lloyd', 'text' => 'I am a master of Laravel and Angular.']
    );

    // Loop through each user above and create the record for them in the database
    foreach ($comments as $comment)
    {
        Comment::create($comment);
    }

    Model::reguard();
    }
}

