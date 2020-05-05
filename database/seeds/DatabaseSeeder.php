<?php

use Illuminate\Database\Seeder;

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
        $this->call(AdminsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(ClassRoomsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
    }
}
