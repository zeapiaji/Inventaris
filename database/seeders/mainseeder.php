<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mainseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'nama'     => 'Baru',
        ]);

        DB::table('status')->insert([
            'nama'     => 'Layak Pakai',
        ]);

        DB::table('status')->insert([
            'nama'     => 'Rusak Ringan',
        ]);

        DB::table('status')->insert([
            'nama'     => 'Rusak Berat',
        ]);

        DB::table('barang')->insert([
            'nama'          => 'Meja',
            'kode'          => 'MJ',
        ]);

        DB::table('barang')->insert([
            'nama'          => 'Kursi',
            'kode'          => 'KS',
        ]);

        DB::table('barang')->insert([
            'nama'          => 'Papan Board',
            'kode'          => 'PB',
        ]);

        DB::table('ruangan')->insert([
            'nama'          => 'X RPL',
        ]);

        DB::table('ruangan')->insert([
            'nama'          => 'XI RPL',
        ]);

        DB::table('ruangan')->insert([
            'nama'          => 'XII RPL',
        ]);

        DB::table('gudang')->insert([
            'barang_id' => 1,
            'total'     => random_int(40, 80),
            'status_id' => 1,
        ]);

        DB::table('gudang')->insert([
            'barang_id' => 2,
            'total'     => random_int(70, 100),
            'status_id' => 2,
        ]);

        DB::table('gudang')->insert([
            'barang_id' => 3,
            'total'     => random_int(3, 3),
            'status_id' => 3,
        ]);

        DB::table('akomodasi')->insert([
            'total'     => random_int(1,35),
            'barang_id' => 1,
            'ruangan_id'  => 1,
            'status_id' => 1,
        ]);

        DB::table('akomodasi')->insert([
            'total'     => random_int(1,60),
            'barang_id' => 2,
            'ruangan_id'  => 2,
            'status_id' => 2,
        ]);

        DB::table('akomodasi')->insert([
            'total'     => random_int(3,3),
            'barang_id' => 3,
            'ruangan_id'  => 3,
            'status_id' => 3,
        ]);

    }
}
