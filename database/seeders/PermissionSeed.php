<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
            'name' => 'Veterinario',
            'guard_name' => 'web',
            'created_at' => Carbon::now('America/Costa_Rica'),
            'updated_at' => Carbon::now('America/Costa_Rica'),
        ]);

          DB::table('roles')->insert([
            'name' => 'Cliente',
            'guard_name' => 'web',
            'created_at' => Carbon::now('America/Costa_Rica'),
            'updated_at' => Carbon::now('America/Costa_Rica'),
        ]);
    }
}
