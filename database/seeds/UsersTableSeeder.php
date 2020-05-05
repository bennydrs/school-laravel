<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Zahir',
                'username' => '123456',
                'role' => 'admin',
                'email' => 'zahir@mail.com',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'Apri',
                'username' => '20201000',
                'role' => 'siswa',
                'email' => 'apri@mail.com',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'Udin',
                'username' => '20201001',
                'role' => 'siswa',
                'email' => 'udin@mail.com',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'Izma',
                'username' => '20201002',
                'role' => 'siswa',
                'email' => 'izma@mail.com',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'Sapardi',
                'username' => 'G1234',
                'role' => 'guru',
                'email' => 'supardi@mail.com',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'Samson',
                'username' => 'G1235',
                'role' => 'guru',
                'email' => 'samson@mail.com',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'Sayuti',
                'username' => 'G1236',
                'role' => 'guru',
                'email' => 'samson@mail.com',
                'password' => bcrypt('123')
            ]
        );
    }
}
