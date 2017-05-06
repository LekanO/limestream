<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
                ['username' => 'Bethel Re Church', 'first_name' => 'Ryan', 'last_name' => 'Chenkie', 'avatar' => 'https://s3-eu-west-1.amazonaws.com/smag-tv/motorola-xoom-with-wi-fi.0.jpg', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
                ['username' => 'Cethel Redeem Church', 'first_name' => 'Chris','last_name' => 'Sevilleja', 'avatar' => 'https://s3-eu-west-1.amazonaws.com/smag-tv/motorola-xoom-with-wi-fi.3.jpg', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
                ['username' => 'Dethel Redeem Church', 'first_name' => 'Holly','last_name' => 'Lloyds', 'avatar' => 'https://s3-eu-west-1.amazonaws.com/smag-tv/motorola-xoom-with-wi-fi.0.jpg', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
                ['username' => 'Eethel Redeem Church', 'first_name' => 'Adnan','last_name' => 'Kukic', 'avatar' => 'https://s3-eu-west-1.amazonaws.com/smag-tv/motorola-xoom-with-wi-fi.3.jpg', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}
