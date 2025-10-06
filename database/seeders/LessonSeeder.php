<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            // Instalação e Configuração (Laravel)
            [
                'module_name' => 'Instalação e Configuração',
                'lessons' => [
                    [
                        'name' => 'Instalando o Laravel via Composer',
                        'description' => 'Aprenda a instalar o Laravel usando o Composer e configurar seu primeiro projeto.',
                        'duration' => 600, // 10 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Configurando o Ambiente',
                        'description' => 'Configuração do arquivo .env, banco de dados e variáveis de ambiente.',
                        'duration' => 720, // 12 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Artisan Commands',
                        'description' => 'Conhecendo os comandos Artisan mais importantes para desenvolvimento.',
                        'duration' => 480, // 8 min
                        'position' => 3,
                    ],
                ],
            ],

            // Estrutura do Projeto (Laravel)
            [
                'module_name' => 'Estrutura do Projeto',
                'lessons' => [
                    [
                        'name' => 'Estrutura de Pastas',
                        'description' => 'Entendendo a organização de pastas e arquivos do Laravel.',
                        'duration' => 600, // 10 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Rotas e Controllers',
                        'description' => 'Como definir rotas e criar controllers no Laravel.',
                        'duration' => 720, // 12 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Blade Templates',
                        'description' => 'Sistema de templates Blade para criar views dinâmicas.',
                        'duration' => 480, // 8 min
                        'position' => 3,
                    ],
                ],
            ],

            // Models e Migrations (Eloquent)
            [
                'module_name' => 'Models e Migrations',
                'lessons' => [
                    [
                        'name' => 'Criando Migrations',
                        'description' => 'Como criar e gerenciar migrations para seu banco de dados.',
                        'duration' => 720, // 12 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Eloquent Models',
                        'description' => 'Criando e configurando models Eloquent.',
                        'duration' => 600, // 10 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Seeders e Factories',
                        'description' => 'Populando o banco de dados com dados de teste.',
                        'duration' => 720, // 12 min
                        'position' => 3,
                    ],
                    [
                        'name' => 'Mass Assignment e Fillable',
                        'description' => 'Proteção contra mass assignment e configuração de campos fillable.',
                        'duration' => 360, // 6 min
                        'position' => 4,
                    ],
                ],
            ],

            // Relacionamentos (Eloquent)
            [
                'module_name' => 'Relacionamentos',
                'lessons' => [
                    [
                        'name' => 'One to One',
                        'description' => 'Relacionamentos um para um no Eloquent.',
                        'duration' => 600, // 10 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'One to Many',
                        'description' => 'Relacionamentos um para muitos.',
                        'duration' => 720, // 12 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Many to Many',
                        'description' => 'Relacionamentos muitos para muitos com pivot tables.',
                        'duration' => 900, // 15 min
                        'position' => 3,
                    ],
                    [
                        'name' => 'Eager Loading',
                        'description' => 'Otimizando consultas com eager loading.',
                        'duration' => 480, // 8 min
                        'position' => 4,
                    ],
                    [
                        'name' => 'Relacionamentos Polimórficos',
                        'description' => 'Relacionamentos avançados polimórficos.',
                        'duration' => 300, // 5 min
                        'position' => 5,
                    ],
                ],
            ],

            // Componentes e JSX (React)
            [
                'module_name' => 'Componentes e JSX',
                'lessons' => [
                    [
                        'name' => 'Introdução ao JSX',
                        'description' => 'Sintaxe JSX e como escrever HTML no JavaScript.',
                        'duration' => 480, // 8 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Componentes Funcionais',
                        'description' => 'Criando componentes funcionais em React.',
                        'duration' => 720, // 12 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Componentes de Classe',
                        'description' => 'Componentes de classe e quando utilizá-los.',
                        'duration' => 600, // 10 min
                        'position' => 3,
                    ],
                    [
                        'name' => 'Aninhamento de Componentes',
                        'description' => 'Como aninhar componentes e criar hierarquias.',
                        'duration' => 600, // 10 min
                        'position' => 4,
                    ],
                ],
            ],

            // Conceitos Fundamentais (Docker)
            [
                'module_name' => 'Conceitos Fundamentais',
                'lessons' => [
                    [
                        'name' => 'O que é Docker?',
                        'description' => 'Introdução aos containers e virtualização.',
                        'duration' => 600, // 10 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Containers vs VMs',
                        'description' => 'Diferenças entre containers e máquinas virtuais.',
                        'duration' => 480, // 8 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Primeiros Comandos Docker',
                        'description' => 'Comandos básicos para trabalhar com Docker.',
                        'duration' => 720, // 12 min
                        'position' => 3,
                    ],
                ],
            ],

            // Widgets Básicos (Flutter)
            [
                'module_name' => 'Widgets Básicos',
                'lessons' => [
                    [
                        'name' => 'Text e Container',
                        'description' => 'Widgets fundamentais para texto e layout.',
                        'duration' => 600, // 10 min
                        'position' => 1,
                    ],
                    [
                        'name' => 'Row e Column',
                        'description' => 'Organizando widgets em linhas e colunas.',
                        'duration' => 720, // 12 min
                        'position' => 2,
                    ],
                    [
                        'name' => 'Stack e Positioned',
                        'description' => 'Sobreposição e posicionamento absoluto.',
                        'duration' => 600, // 10 min
                        'position' => 3,
                    ],
                    [
                        'name' => 'ListView e GridView',
                        'description' => 'Listas e grades de elementos.',
                        'duration' => 900, // 15 min
                        'position' => 4,
                    ],
                    [
                        'name' => 'Image e Icons',
                        'description' => 'Trabalhando com imagens e ícones.',
                        'duration' => 480, // 8 min
                        'position' => 5,
                    ],
                    [
                        'name' => 'Buttons e GestureDetector',
                        'description' => 'Botões e detecção de gestos.',
                        'duration' => 690, // 11.5 min
                        'position' => 6,
                    ],
                ],
            ],
        ];

        foreach ($lessons as $moduleData) {
            $module = Module::where('name', $moduleData['module_name'])->first();

            if ($module) {
                foreach ($moduleData['lessons'] as $lessonData) {
                    $lesson = array_merge($lessonData, [
                        'module_id' => $module->id,
                        'slug' => Str::slug($lessonData['name']),
                        'panda_id' => null, // Placeholder - seria preenchido com IDs reais do Panda Video
                        'panda_player_url' => null,
                        'panda_thumbnail_url' => null,
                        'transcription_url' => null,
                        'resume' => 'Resumo da aula: ' . $lessonData['description'],
                    ]);

                    Lesson::firstOrCreate([
                        'module_id' => $module->id,
                        'name' => $lessonData['name'],
                    ], $lesson);
                }
            }
        }
    }
}
