<?php

use App\Customer;
use App\Role;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $role_user = Role::where('name', 'user')->first();

        foreach($role_user->users as $user) {
            $customer = new Customer();

            $customer->address = $faker->address;
            $customer->phone = $this->random_phone();
            $customer->user_id = $user->id;
            $customer->save();
        }
    }
    private function random_phone() {
        return '0' . 
            $this->random_str(2, '0123456789'). '-' . 
            $this->random_str(7, '0123456789');
    }
    //fill in keyspace
    private function random_str($length, $keyspace) {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        };
        return implode('', $pieces);
    }
}
