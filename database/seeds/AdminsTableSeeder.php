<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO admins (id, nip, user_id, nama, tempat_lahir, tanggal_lahir, janis_kelamin, agama, telp, alamat, foto, created_at, updated_at) VALUES
        (1, '123456', 1, 'Zahir', 'Bogor', '2020-02-01', 'Laki-laki', 'Islam', '081-8181-8181', 'Bogor, Jawa Barat', NULL, '2020-02-18 20:10:26', '2020-03-29 20:27:27');");
    }
}
