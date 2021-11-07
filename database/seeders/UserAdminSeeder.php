<?php

namespace Database\Seeders;
use App\Models\Veterinary;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $veterinario = new Veterinary;
        $veterinario->id = "123";
        $veterinario->nombre = "Admin";
        $veterinario->primerApellido = "SICOVE";
        $veterinario->segundoApellido = "CR";
        $veterinario->correo = "admin@sicovecr.pw";
        $veterinario->telefono = "12312312";
        $veterinario->save();

        if ($veterinario) {
            $user = new User;
            $user->name = $veterinario->nombre." ". $veterinario->primerApellido. " " . $veterinario->segundoApellido;
            $user->email = $veterinario->correo;
            $temporal_password = "admin123";
            $user->password =  Hash::make($temporal_password);
            $user->save();

            if ($user)
            {
                $user->assignRole('Veterinario');
                //SendMailEmployee::dispatch($user, $temporal_password);
            }
        }
    }
}
