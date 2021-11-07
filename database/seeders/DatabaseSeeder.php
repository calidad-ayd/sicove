<?php

namespace Database\Seeders;
use Database\Seeders\PermissionSeed;
use Database\Seeders\UserAdminSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	PermissionSeed::class,
            UserAdminSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
