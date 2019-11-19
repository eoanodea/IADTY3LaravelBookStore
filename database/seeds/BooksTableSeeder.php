<?php

use App\Publisher;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    private $amountOfPublishers = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->amountOfPublishers = Publisher::count();

        factory(App\Book::class, 50)->create([
            'publisher_id' => function() { return mt_rand(1, $this->amountOfPublishers); }
        ]);
    }
}
