<?php

use App\Contact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $contacts = array(
            ['user_id' => 2, 'address1' => '3 Haskard Road', 'address2' => '', 'city' => 'Essex', 'country' => 'England', 'post_code' => 'RM10 7TT'],
            ['user_id' => 2, 'address1' => '6 Haskard Road', 'address2' => '', 'city' => 'Essex', 'country' => 'England', 'post_code' => 'RM10 7TT'],
            ['user_id' => 2, 'address1' => '9 Haskard Road', 'address2' => '', 'city' => 'Essex', 'country' => 'England', 'post_code' => 'RM10 7TT'],
            ['user_id' => 2, 'address1' => '89 Haskard Road', 'address2' => '', 'city' => 'Essex', 'country' => 'England', 'post_code' => 'RM10 7TT'],
            ['user_id' => 2, 'address1' => '10 Haskard Road', 'address2' => '', 'city' => 'Essex', 'country' => 'England', 'post_code' => 'RM10 7TT']     
     );

    // Loop through each user above and create the record for them in the database
    foreach ($contacts as $contact)
    {
        Contact::create($contact);
    }

    Model::reguard();
    }
}

