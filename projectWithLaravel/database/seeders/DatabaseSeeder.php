<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khachhang')->insert([
            [
                'khachhangid' => 2000,
                'tenkhachhang' => 'Linh Chi',
                'username' => 'khachhang1',
                'email' => 'khachhang@gmail.com',
                'password' => bcrypt('123'),
            ]
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
