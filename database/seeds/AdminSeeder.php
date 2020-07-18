<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // categories
        DB::table('users')->insert([
            [
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password' => Hash::make('3c4t4l0g!'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
