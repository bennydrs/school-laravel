<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO semesters (id, kode_semester, semester, tahun_ajaran, created_at, updated_at) values (1, 'SM192001', 'Genap', '2019/2020', '2020-02-14 22:06:45', '2020-02-14 22:06:45'),
        (2, 'SM192002', 'Ganjil', '2019/2020', '2020-02-14 22:12:43', '2020-02-14 22:12:43'),
        (4, 'SM212201', 'Genap', '2021/2022', '2020-03-03 21:16:22', '2020-03-03 21:16:22'),
        (5, 'SM212202', 'Ganjil', '2021/2022', '2020-03-03 21:17:26', '2020-03-03 21:17:26'),
        (6, 'SM222301', 'Genap', '2022/2023', '2020-03-13 21:09:26', '2020-03-13 21:09:26');");
    }
}
