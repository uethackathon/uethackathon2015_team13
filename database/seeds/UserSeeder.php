<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        $user = User::find(1);
        $user->name = "Anonymous user";
        $user->password = bcrypt(str_random(256));
        $user->save();
    }
}
