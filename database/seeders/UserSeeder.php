<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $check = User::where('phone',998990065551)->first();
        if (empty($check)){
            $user = new User();
            $user->role_id = 1;
            $user->name = "Admin";
            $user->email = "admin@gmail.com";
            $user->phone = 998990065551;
            $user->password = bcrypt('0000');
            $user->save();
        } 
    }
}
