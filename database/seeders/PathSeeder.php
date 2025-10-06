<?php

namespace Database\Seeders;

use App\Models\Path;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = [
            // Laravel Paths
            [
                'name' => 'Introdução ao Laravel',
                'slug' => 'introducao-laravel',
                'description' => 'Primeiros passos com o framework Laravel, instalação e configuração básica.',
                'cover' => 'laravel-intro-path.jpg',
                'duration' => 3600, // 1 hora
            ],
            [
                'name' => 'Eloquent ORM',
                'slug' => 'eloquent-orm',
                'description' => 'Domine o ORM do Laravel para trabalhar com bancos de dados de forma elegante.',
                'cover' => 'eloquent-path.jpg',
                'duration' => 7200, // 2 horas
            ],
            [
                'name' => 'APIs REST com Laravel',
                'slug' => 'apis-rest-laravel',
                'description' => 'Criação de APIs robustas e escaláveis usando Laravel.',
                'cover' => 'laravel-api-path.jpg',
                'duration' => 5400, // 1.5 horas
            ],
            [
                'name' => 'Autenticação e Autorização',
                'slug' => 'autenticacao-autorizacao',
                'description' => 'Sistemas de login, registro e controle de acesso.',
                'cover' => 'auth-path.jpg',
                'duration' => 4800, // 1.33 horas
            ],

            // Frontend Paths
            [
                'name' => 'React Fundamentals',
                'slug' => 'react-fundamentals',
                'description' => 'Conceitos básicos do React: componentes, props, state e eventos.',
                'cover' => 'react-fundamentals-path.jpg',
                'duration' => 6000, // 1.67 horas
            ],
            [
                'name' => 'React Hooks',
                'slug' => 'react-hooks',
                'description' => 'useState, useEffect e hooks customizados.',
                'cover' => 'react-hooks-path.jpg',
                'duration' => 4500, // 1.25 horas
            ],
            [
                'name' => 'Vue.js Básico',
                'slug' => 'vuejs-basico',
                'description' => 'Introdução ao Vue.js e seu ecossistema.',
                'cover' => 'vue-basic-path.jpg',
                'duration' => 5400, // 1.5 horas
            ],
            [
                'name' => 'TypeScript Essentials',
                'slug' => 'typescript-essentials',
                'description' => 'Tipagem estática para JavaScript moderno.',
                'cover' => 'typescript-path.jpg',
                'duration' => 7200, // 2 horas
            ],

            // DevOps Paths
            [
                'name' => 'Docker Básico',
                'slug' => 'docker-basico',
                'description' => 'Containers, imagens e docker-compose.',
                'cover' => 'docker-basic-path.jpg',
                'duration' => 5400, // 1.5 horas
            ],
            [
                'name' => 'AWS EC2 e RDS',
                'slug' => 'aws-ec2-rds',
                'description' => 'Deploy de aplicações na nuvem AWS.',
                'cover' => 'aws-path.jpg',
                'duration' => 6600, // 1.83 horas
            ],
            [
                'name' => 'CI/CD Pipeline',
                'slug' => 'cicd-pipeline',
                'description' => 'Automação de testes e deploy.',
                'cover' => 'cicd-path.jpg',
                'duration' => 4800, // 1.33 horas
            ],

            // Database Paths
            [
                'name' => 'Otimização MySQL',
                'slug' => 'otimizacao-mysql',
                'description' => 'Índices, queries eficientes e performance.',
                'cover' => 'mysql-optimization-path.jpg',
                'duration' => 7800, // 2.17 horas
            ],
            [
                'name' => 'PostgreSQL Avançado',
                'slug' => 'postgresql-avancado',
                'description' => 'Recursos avançados do PostgreSQL.',
                'cover' => 'postgresql-path.jpg',
                'duration' => 6000, // 1.67 horas
            ],

            // Mobile Paths
            [
                'name' => 'Flutter Setup',
                'slug' => 'flutter-setup',
                'description' => 'Configuração do ambiente Flutter.',
                'cover' => 'flutter-setup-path.jpg',
                'duration' => 3000, // 50 min
            ],
            [
                'name' => 'Widgets Flutter',
                'slug' => 'widgets-flutter',
                'description' => 'Widgets básicos e customizados.',
                'cover' => 'flutter-widgets-path.jpg',
                'duration' => 8400, // 2.33 horas
            ],
            [
                'name' => 'State Management Flutter',
                'slug' => 'state-management-flutter',
                'description' => 'Provider, Bloc e Riverpod.',
                'cover' => 'flutter-state-path.jpg',
                'duration' => 7200, // 2 horas
            ],
        ];

        foreach ($paths as $path) {
            Path::firstOrCreate(['slug' => $path['slug']], $path);
        }
    }
}
