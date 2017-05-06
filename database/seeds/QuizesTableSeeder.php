<?php

use App\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class QuizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizes = array(
                ['video_id' => 1, 'index' => 0, 'showAt' => 20, 'correct' => '0', 'show' => false, 'question' => 'How much amazing Videogular is?'],
                ['video_id' => 2, 'index' => 1, 'showAt' => 40, 'correct' => '1', 'show' => false, 'question' => 'Carl Sagan was...']
         );

        // Loop through each user above and create the record for them in the database
        foreach ($quizes as $quiz)
        {
            Quiz::create($quiz);
        }

        Model::reguard();
    }
}
