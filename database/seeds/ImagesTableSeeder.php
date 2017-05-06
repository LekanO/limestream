<?php

use App\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $images = array(
            ['user_id' => 1, 'mime_type' => 'This mime', 'file_size' => 'This file size', 'file_name' => 'This is the title', 'file_path' => 'The file path', 'type' => 'S3']

     );

    // Loop through each user above and create the record for them in the database
    foreach ($images as $image)
    {
        Image::create($image);
    }

    Model::reguard();
    }
}

