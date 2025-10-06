<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = [
            [
                'name' => 'Fundamentos do Laravel',
                'description' => 'Aprenda os conceitos fundamentais do framework Laravel, desde instalação até conceitos avançados.',
            ],
            [
                'name' => 'Laravel Avançado',
                'description' => 'Técnicas avançadas, patterns, performance e boas práticas para desenvolvimento Laravel.',
            ],
            [
                'name' => 'Frontend com React',
                'description' => 'Desenvolvimento de interfaces modernas e reativas usando React.js.',
            ],
            [
                'name' => 'Vue.js Essencial',
                'description' => 'Framework progressivo para desenvolvimento de SPAs e interfaces dinâmicas.',
            ],
            [
                'name' => 'TypeScript para Desenvolvedores',
                'description' => 'Tipagem estática para JavaScript, melhorando a qualidade e manutenibilidade do código.',
            ],
            [
                'name' => 'Docker e Containers',
                'description' => 'Containerização de aplicações para desenvolvimento e produção.',
            ],
            [
                'name' => 'AWS Fundamentals',
                'description' => 'Conceitos fundamentais da Amazon Web Services para deploy e escalabilidade.',
            ],
            [
                'name' => 'CI/CD com GitHub Actions',
                'description' => 'Automação de deploy e testes usando GitHub Actions.',
            ],
            [
                'name' => 'MySQL Avançado',
                'description' => 'Otimização de queries, índices e administração avançada de MySQL.',
            ],
            [
                'name' => 'PostgreSQL Professional',
                'description' => 'Recursos avançados do PostgreSQL para aplicações empresariais.',
            ],
            [
                'name' => 'Flutter Básico',
                'description' => 'Introdução ao desenvolvimento mobile com Flutter.',
            ],
            [
                'name' => 'Flutter Avançado',
                'description' => 'Desenvolvimento de apps complexos, state management e arquitetura.',
            ],
            [
                'name' => 'Dart Language',
                'description' => 'Linguagem de programação Dart para desenvolvimento Flutter.',
            ],
        ];

        foreach ($tracks as $track) {
            Track::firstOrCreate(['name' => $track['name']], $track);
        }
    }
}
