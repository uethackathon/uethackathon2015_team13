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

        $user = User::find(2);
        $user->name = "Moderator";
        $user->email = "mod@feedback.dev";
        $user->password = bcrypt('uethackathon');
        $user->save();

        $user = User::find(3);
        $user->name = "Staff";
        $user->email = "staff@feedback.dev";
        $user->password = bcrypt('staff');
        $user->save();
    }
}
