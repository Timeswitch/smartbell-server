<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \SmartBell\User::create([
            'email' => 'test@123.de',
            'password' => bcrypt('123')
        ]);

        $bell = \SmartBell\Bell::create([
            'name' => "Test Klingel",
            'user_id' => $user->id,
            'active' => 1,
            'uuid' => Uuid::generate(1)->string
        ]);
        $bell->name = "Test Klingel";
        $bell->user_id = $user->id;
        $bell->active = true;
        $bell->save();

        for($i = 0; $i < 10; $i++){
            \SmartBell\Ring::create([
                'user_id' => $user->id,
                'bell_id' => $bell->id,
                'file' => ''
            ]);
        }
    }
}
