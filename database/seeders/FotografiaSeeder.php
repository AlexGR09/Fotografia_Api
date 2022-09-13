<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FotografiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            ['id' => 1,
             'username' => 'Consultor',
             'nombre' => "Alexis",
             'paterno' => "Garcia",
             'email' => 'root@root.com',
             'password' => 'root'],

             ['id' => 2,
             'username' => 'ricardomar',
             'nombre' => "Ricardo",
             'paterno' => "Martínez",
             'email' => 'rm@studio.com',
             'password' => 'root'],

             ['id' => 3,
             'username' => 'alansch',
             'nombre' => "Alan",
             'paterno' => "Sanchez",
             'email' => 'as@studio.com',
             'password' => 'root'],

             ['id' => 4,
             'username' => 'hermantl',
             'nombre' => "Herman",
             'paterno' => "Toala",
             'email' => 'ht@studio.com',
             'password' => 'root'],

             ['id' => 5,
             'username' => 'davidch',
             'nombre' => "David",
             'paterno' => "Chacon",
             'email' => 'dc@studio.com',
             'password' => 'root'],
        ]);

        DB::table('fotografias')->insert([
            [
                'fotografo_id' => 2,
                'imagen' => "url:",
                'fecha' => "2022-04-11",
                'descripcion' => "paisaje de media noche",
                'categoria_id' => 1,
                'tecnica' => "Clave baja",
                'camara' => "Canon t500",
                'objetivo' => "Sigma 50mm",
                'iso' => "200",
                'balance' => "6500k",
                'velocidad' => "1/80s",
                'diafragma' => "+0.9"
            ],
            [
                'fotografo_id' => 2,
                'imagen' => "url:",
                'fecha' => "2022-05-05",
                'descripcion' => "vista a la marea",
                'categoria_id' => 1,
                'tecnica' => "Agua con efecto seda",
                'camara' => "Canon PowerShot G1 X",
                'objetivo' => "EF 35mm",
                'iso' => "180",
                'balance' => "4500k",
                'velocidad' => "0.3s",
                'diafragma' => "+1.2"
            ],
            [
                'fotografo_id' => 3,
                'imagen' => "url:",
                'fecha' => "2021-12-25",
                'descripcion' => "noche buena",
                'categoria_id' => 5,
                'tecnica' => "Barrido de movimiento",
                'camara' => "Nikon D850",
                'objetivo' => "Sigma 24mm",
                'iso' => "360",
                'balance' => "3000k",
                'velocidad' => "0.6s",
                'diafragma' => "+1.9"
            ],
            [
                'fotografo_id' => 1,
                'imagen' => "url:",
                'fecha' => "2019-10-19",
                'descripcion' => "la felicidad es notoria",
                'categoria_id' => 7,
                'tecnica' => "Lightpainting",
                'camara' => "Canon EOS M6",
                'objetivo' => "Tamron SP 85",
                'iso' => "600",
                'balance' => "7000k",
                'velocidad' => "1.2s",
                'diafragma' => "-0.5"
            ]
        ]);

        DB::table('categorias')->insert([
            [
                'nombre' => "Fotografía Publicitaria"
            ],
            [
                'nombre' => "Fotografía de Retrato"
            ],
            [
                'nombre' => "Reportaje Fotográfico"
            ],
            [
                'nombre' => "Fotografía de Paisajes"
            ],
            [
                'nombre' => "Fotografía de Deportes"
            ],
            [
                'nombre' => "Fotografía Abstracta"
            ],
            [
                'nombre' => "Fotografía de Alimentos"
            ],
        ]);

        DB::table('fotografos')->insert([
            [
                'experiencia' => 3,
                'marca' => "KB Studio",
                'logo' => "url:",
                'user_id' => 2
            ],
            [
                'experiencia' => 5,
                'marca' => "David Copado",
                'logo' => "url:",
                'user_id' => 3
            ],
            [
                'experiencia' => 1,
                'marca' => "s/m",
                'logo' => "url:",
                'user_id' => 4
            ],
        ]);
    }
}
