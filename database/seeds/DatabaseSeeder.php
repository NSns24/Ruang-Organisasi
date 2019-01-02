<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        DB::table('users')->insert([
            [
                'email' => 'testes@gmail.com',
                'password' => Hash::make('123456'),
                'name' => 'TesTes',
                'contact_number' => '096575675656',
                'profile_picture' => '1_TesTes.jpg'
            ],
            [
                'email' => 'testes2@gmail.com',
                'password' => Hash::make('123456'),
                'name' => 'TesTes2',
                'contact_number' => '096575675656',
                'profile_picture' => '2_TesTes2.jpg'
            ]
        ]);

        DB::table('projects')->insert(
            [
                'user_id' => 1,
                'project_name' => 'TesTes',
                'project_description' => 'TesTes Project',
                'project_deadline' => '2019-01-10', 
                'project_progress' => 0,
                'project_image' => '1_1_TesTes.jpg'
            ]
        );

        DB::table('project_details')->insert(
            [
                'project_id' => 1,
                'user_id' => 2
            ]
        );
    }
}
