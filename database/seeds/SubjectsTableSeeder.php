<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO subjects (id, kode_mapel, nama, created_at, updated_at) values (1, 'MP101', 'Matematika', '2020-02-12 18:38:17', '2020-02-12 18:38:17'),
        (2, 'MP102', 'Bahasa Indonesia', '2020-02-16 19:43:00', '2020-02-16 19:43:00'),
        (4, 'MP103', 'PKN', '2020-03-06 21:13:33', '2020-03-06 21:13:33'),
        (5, 'MP104', 'Bahasa Inggris', '2020-03-06 22:13:33', '2020-03-06 22:13:33');");
    }
}
