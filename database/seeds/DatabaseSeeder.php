<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        if (empty($users)) {

            $faker = Faker::create();
            foreach (range(1, 10) as $index) {
                DB::table('users')->insert([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt('secret'),
                ]);
            }
        }

        $admins = \App\Admin::all();
        if ($admins) {

            $faker = Faker::create();
            foreach (range(1, 2) as $index) {
                DB::table('admins')->insert([
                    'name' => $faker->name,
                    'email' => 'ismail@test.com',
                    'lang' => 'en',
                    'password' => bcrypt('123456'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }
}
