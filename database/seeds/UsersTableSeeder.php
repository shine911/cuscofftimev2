<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //DB::table('users')->truncate();
        App\User::create([
            'name' => 'Admin',
            'email' =>'admin@cusc.vn',
            'password' => bcrypt('admin'),
            'roles' => true,
        ]);

        App\User::create([
            'name' => 'User',
            'email' =>'user@cusc.vn',
            'password' => bcrypt('user'),
            'roles' => false,
        ]);
        
        App\CourseTypes::create([
            'name' => 'Dài hạn'
        ]);

        App\CourseTypes::create([
            'name' => 'Ngắn hạn'
        ]);
        
        App\Courses::create([
            'name' => 'ACCPi17',
            'type_id' => 1
        ]);

        App\Subjects::create([
            'name' => 'C# Developement',
            'amount' => 12,
            'semester' => 2,
            'course_id' => 1,
        ]);
    }
}
