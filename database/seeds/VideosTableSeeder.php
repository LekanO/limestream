<?php

use App\Video;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = array(
                ['user_id' => 1, 'title' => 'The First', 'src' => 'http://static.videogular.com/assets/videos/videogular.mp4', 'type' => 'video/mp4'],
                ['user_id' => 2, 'title' => 'The Sec', 'src' => 'http://static.videogular.com/assets/videos/videogular.mp4', 'type' => 'video/mp4'],
                ['user_id' => 3, 'title' => 'The Third', 'src' => 'http://static.videogular.com/assets/videos/videogular.mp4', 'type' => 'video/mp4'],
                ['user_id' => 4, 'title' => 'The Forth', 'src' => 'http://static.videogular.com/assets/videos/videogular.mp4', 'type' => 'video/mp4']
        );

        // Loop through each user above and create the record for them in the database
        foreach ($videos as $video)
        {
            Video::create($video);
        }

        Model::reguard();
    }
}
