<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'tensanpham' => Str::random(10),
                'mota' => Str::random(10),
                'giasanpham' => 5000];
        }
        DB::table('sanpham')->insert($data);
    }
}
