<?php

use Illuminate\Database\Seeder;
use Faker\Generator;


class FakeClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=1;$i<=10;$i++) {
            $n = new App\Client;
            $n->name = $faker->firstName;
            $n->surname = $faker->lastName;
            $n->phone_number= $faker->phoneNumber;
            $n->save();
        }
    }
}
