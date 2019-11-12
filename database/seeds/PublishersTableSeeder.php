<?php

use App\Publisher;
use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        //Create a few articles in our DB
        for ($i = 0; $i < 5; $i++) {
            $publisher = new Publisher();
            $publisher->name = $faker->company;
            $publisher->address = $faker->address;
            $publisher->save();
        }
    }
}
