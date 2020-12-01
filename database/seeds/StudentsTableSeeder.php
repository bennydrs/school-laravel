<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO students (id, nis, user_id, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, foto, created_at, updated_at) VALUES (1, '20201000', 2, 'Apri', 'Bogor', '2003-04-01', 'Perempuan', 'Islam', 'Bogor, Jawa Barat', NULL, '2020-02-09 19:25:27', '2020-03-29 21:26:48'),
        (2, '20201001', 3, 'Udin', 'Bogor', '2020-02-01', 'Laki-laki', 'Islam', 'Udin', NULL, '2020-02-26 20:42:38', '2020-02-26 20:42:38'),
        (3, '20201002', 4, 'Izma', 'Bogor', '2020-02-02', 'Perempuan', 'Islam', 'ss', NULL, '2020-02-28 21:41:50', '2020-02-28 21:41:50');");
    }
}
