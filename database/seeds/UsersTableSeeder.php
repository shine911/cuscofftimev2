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
            'name' => 'Badman',
            'email' =>'badman@gmail.com',
            'password' => bcrypt('12345678')
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
