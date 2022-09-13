<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Consultor'],
            ['id' => 2, 'nombre' => 'Fotografo'],
        ]);

        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2],
            ['user_id' => 3, 'role_id' => 2],
            ['user_id' => 4, 'role_id' => 2],
            ['user_id' => 5, 'role_id' => 2],
        ]);

        DB::table('permisos')->insert([
            ['id' => 1, 'nombre' => 'Fotografia'],

        ]);

        DB::table('permisionables')->insert([
            [ 'permisionable_id' => 1, 'permisionable_type' => 'App\Models\Role', 'permiso_id' => 1, 'c' => 0,'r' => 1,'u' => 0,'d' => 0],
            [ 'permisionable_id' => 2, 'permisionable_type' => 'App\Models\Role', 'permiso_id' => 1, 'c' => 1,'r' => 1,'u' => 1,'d' => 1],
        ]);
    }
}
