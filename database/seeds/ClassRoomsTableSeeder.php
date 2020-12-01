<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO class_rooms (id, kode_kelas, nama, created_at, updated_at) values (1, 'K100', '10 A', '2020-02-11 20:25:15', '2020-03-25 03:17:05'),
        (2, 'K101', '10 B', '2020-02-11 20:27:29', '2020-03-25 03:17:38'),
        (3, 'K102', '10 C', '2020-02-12 20:33:50', '2020-03-25 03:17:54');");
    }
}
