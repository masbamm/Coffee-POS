<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rofi',
            'email' => 'admin@coffee.id',
            'password' => bcrypt('secret'),
            'status' => true,
            'email_verified_at' => Carbon::now(),
            'role' => 'admin'
        ]);
    }
}