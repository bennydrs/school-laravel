<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO teachers (id, nrg, user_id, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, telp, alamat, created_at, updated_at) values (1, 'G1234', 5, 'Supardi', 'Arab', '1995-02-10', 'Laki-laki', 'Islam', '087-8555-4444', 'Arab', '2020-02-09 21:41:40', '2020-02-11 19:39:24'), 
        (2, 'G1235', 6, 'Samson', 'Jakarta', '1988-02-01', 'Laki-laki', 'Islam', '085-0005-5454', 'Jakarta Barat', '2020-02-11 19:13:33', '2020-02-11 19:13:33'),
        (3, 'G1236', 7, 'Sayuti', 'Jakarta', '2020-02-02', 'Laki-laki', 'Islam', '090-9090-9090', 'jakarta', '2020-02-12 20:12:28', '2020-02-12 20:12:28');");
    }
}
