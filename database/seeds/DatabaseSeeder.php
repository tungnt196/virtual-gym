<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('hlv')->insert([
            'name' => "Tùng",
            'email' => 'nguyenthetung191196@gmail.com',
            'birthday' => '1996-11-19',
            'password' => '12345678',
            'telephone' => '0978571346',
        ]);
    }
}
