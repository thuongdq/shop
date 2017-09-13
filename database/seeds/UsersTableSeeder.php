<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'thuongdq@gmail.com',
            'password' => bcrypt('123123'),
            'remember_token' => str_random(10),
        ]);
        $admin->roles()->attach(1);

        $writer = User::create([
            'name' => 'writer',
            'email' => 'thuongdq.mon@gmail.com',
            'password' => bcrypt('123123'),
            'remember_token' => str_random(10),
        ]);
        $writer->roles()->attach(2);

        $seller = User::create([
            'name' => 'seller',
            'email' => 'thuongdqqthl@gmail.com',
            'password' => bcrypt('123123'),
            'remember_token' => str_random(10),
        ]);
        $seller->roles()->attach(3);

        factory(User::class, 50)->create()->each(function ($user){
            $user->avatar = 'avatars/team'.rand(1,26).'.jpg';
            $user->save();
            $user->roles()->attach(4);
        });
    }
}
