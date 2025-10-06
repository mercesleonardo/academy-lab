<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonMaterial;
use App\Models\MaterialType;
use Illuminate\Database\Seeder;

class LessonMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materialTypes = MaterialType::all()->keyBy('name');

        $materials = [
            // Materiais para aulas de Laravel
            [
                'lesson_name' => 'Instalando o Laravel via Composer',
                'materials' => [
                    [
                        'title' => 'Documentação Oficial do Laravel',
                        'material_type' => 'Link',
                        'file' => 'https://laravel.com/docs/installation',
                        'description' => 'Link para a documentação oficial de instalação do Laravel.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Comandos de Instalação',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'composer create-project laravel/laravel example-app',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'Configurando o Ambiente',
                'materials' => [
                    [
                        'title' => 'Exemplo de arquivo .env',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Exemplo de configuração do arquivo .env para desenvolvimento.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Guia de Configuração PDF',
                        'material_type' => 'PDF',
                        'file' => 'materiais/laravel-config-guide.pdf',
                        'description' => 'Guia completo de configuração do ambiente Laravel.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'Criando Migrations',
                'materials' => [
                    [
                        'title' => 'Schema Builder Reference',
                        'material_type' => 'Link',
                        'file' => 'https://laravel.com/docs/migrations',
                        'description' => 'Referência completa do Schema Builder do Laravel.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exemplos de Migrations',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Exemplos práticos de migrations para diferentes cenários.',
                        'position' => 2,
                    ],
                    [
                        'title' => 'Exercícios de Migration',
                        'material_type' => 'Exercício',
                        'file' => 'exercicios/migrations-exercicios.pdf',
                        'description' => 'Exercícios práticos para fixar o conhecimento em migrations.',
                        'position' => 3,
                    ],
                ],
            ],

            // Materiais para aulas de React
            [
                'lesson_name' => 'Introdução ao JSX',
                'materials' => [
                    [
                        'title' => 'Documentação JSX',
                        'material_type' => 'Link',
                        'file' => 'https://reactjs.org/docs/introducing-jsx.html',
                        'description' => 'Documentação oficial do React sobre JSX.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exemplos de JSX',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Exemplos práticos de sintaxe JSX.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'Componentes Funcionais',
                'materials' => [
                    [
                        'title' => 'Template de Componente',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Template básico para criação de componentes funcionais.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exercícios de Componentes',
                        'material_type' => 'Exercício',
                        'file' => 'exercicios/react-components.zip',
                        'description' => 'Exercícios práticos para criar componentes React.',
                        'position' => 2,
                    ],
                ],
            ],

            // Materiais para aulas de Docker
            [
                'lesson_name' => 'O que é Docker?',
                'materials' => [
                    [
                        'title' => 'Docker Overview',
                        'material_type' => 'Link',
                        'file' => 'https://docs.docker.com/get-started/overview/',
                        'description' => 'Visão geral oficial do Docker.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Infográfico Docker vs VM',
                        'material_type' => 'Imagem',
                        'file' => 'imagens/docker-vs-vm-infographic.png',
                        'description' => 'Comparação visual entre Docker e VMs.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'Primeiros Comandos Docker',
                'materials' => [
                    [
                        'title' => 'Cheat Sheet Docker',
                        'material_type' => 'PDF',
                        'file' => 'materiais/docker-cheatsheet.pdf',
                        'description' => 'Comandos Docker mais utilizados.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exemplos de Comandos',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'docker run hello-world\ndocker ps\ndocker images',
                        'position' => 2,
                    ],
                ],
            ],

            // Materiais para aulas de Flutter
            [
                'lesson_name' => 'Text e Container',
                'materials' => [
                    [
                        'title' => 'Flutter Widget Catalog',
                        'material_type' => 'Link',
                        'file' => 'https://docs.flutter.dev/development/ui/widgets',
                        'description' => 'Catálogo oficial de widgets do Flutter.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exemplos de Text Widget',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Exemplos práticos de uso do widget Text.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'Row e Column',
                'materials' => [
                    [
                        'title' => 'Layout Widgets Guide',
                        'material_type' => 'PDF',
                        'file' => 'materiais/flutter-layout-guide.pdf',
                        'description' => 'Guia completo de widgets de layout no Flutter.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Exercícios de Layout',
                        'material_type' => 'Exercício',
                        'file' => 'exercicios/flutter-layout-exercises.dart',
                        'description' => 'Exercícios práticos de layout com Row e Column.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'lesson_name' => 'ListView e GridView',
                'materials' => [
                    [
                        'title' => 'Lista de Exemplos',
                        'material_type' => 'Código',
                        'file' => null,
                        'description' => 'Códigos de exemplo para ListView e GridView.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Performance Tips',
                        'material_type' => 'Documento',
                        'file' => 'materiais/flutter-performance-tips.md',
                        'description' => 'Dicas de performance para listas grandes.',
                        'position' => 2,
                    ],
                    [
                        'title' => 'Quiz sobre Listas',
                        'material_type' => 'Quiz',
                        'file' => 'quiz/flutter-lists-quiz.json',
                        'description' => 'Quiz interativo sobre ListView e GridView.',
                        'position' => 3,
                    ],
                ],
            ],
        ];

        foreach ($materials as $lessonData) {
            $lesson = Lesson::where('name', $lessonData['lesson_name'])->first();

            if ($lesson) {
                foreach ($lessonData['materials'] as $materialData) {
                    $materialType = $materialTypes->get($materialData['material_type']);

                    if ($materialType) {
                        LessonMaterial::firstOrCreate([
                            'lesson_id' => $lesson->id,
                            'title' => $materialData['title'],
                        ], [
                            'lesson_id' => $lesson->id,
                            'material_type_id' => $materialType->id,
                            'title' => $materialData['title'],
                            'file' => $materialData['file'],
                            'description' => $materialData['description'],
                            'position' => $materialData['position'],
                        ]);
                    }
                }
            }
        }
    }
}
