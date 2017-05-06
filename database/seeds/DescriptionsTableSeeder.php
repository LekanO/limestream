<?php

use App\Description;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptions = array(
                ['user_id' => 2, 'description' => 'This is the description about Cethel', 'organisation' => 'Photography', 'favourite_quote' => 'This is Life'],
                ['user_id' => 1, 'description' => 'This is the description about Bethel', 'organisation' => 'Church', 'favourite_quote' => 'There is Light at the end of the tunnel'],
                ['user_id' => 3, 'description' => 'This is the description about Dethel', 'organisation' => 'Church', 'favourite_quote' => 'Such is Life'],
                ['user_id' => 4, 'description' => 'This is the description about Eethel', 'organisation' => 'Church', 'favourite_quote' => 'This is Life'],

         );

        // Loop through each user above and create the record for them in the database
        foreach ($descriptions as $description)
        {
            Description::create($description);
        }

        Model::reguard();
    }
}
