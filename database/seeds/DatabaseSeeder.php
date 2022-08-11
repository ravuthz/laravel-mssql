<?php

use App\User;
use App\Security;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123123'
        ]);

        Security::create(['code' => 'helloworld']);
        Security::create(['code' => 'welcomehere']);
    }
}
