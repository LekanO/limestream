<?php

use App\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
                ['user_id' => 2, 'type' => 'Phone Number', 'value' => '555-1234-1234'],
                ['user_id' => 2, 'type' => 'Email', 'value' => 'alice@mailinator.com'],
                ['user_id' => 1, 'type' => 'Phone Number', 'value' => '555-1234-1244'],
                ['user_id' => 1, 'type' => 'Email', 'value' => 'eve@mailinator.com'],
                ['user_id' => 3, 'type' => 'Phone Number', 'value' => '555-1234-1644'],
                ['user_id' => 3, 'type' => 'Email', 'value' => 'many@mailinator.com'],
                ['user_id' => 4, 'type' => 'Phone Number', 'value' => '666-1234-1644'],
                ['user_id' => 4, 'type' => 'Email', 'value' => 'kid@mailinator.com'],
         );

        // Loop through each user above and create the record for them in the database
        foreach ($items as $item)
        {
            Item::create($item);
        }

        Model::reguard();
    }
}
