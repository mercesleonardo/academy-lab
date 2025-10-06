<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Path;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            // Introdução ao Laravel
            [
                'path_slug' => 'introducao-laravel',
                'modules' => [
                    [
                        'name' => 'Instalação e Configuração',
                        'description' => 'Como instalar o Laravel e configurar o ambiente de desenvolvimento.',
                        'position' => 1,
                        'duration' => 1800, // 30 min
                    ],
                    [
                        'name' => 'Estrutura do Projeto',
                        'description' => 'Entendendo a estrutura de pastas e arquivos do Laravel.',
                        'position' => 2,
                        'duration' => 1800, // 30 min
                    ],
                ],
            ],

            // Eloquent ORM
            [
                'path_slug' => 'eloquent-orm',
                'modules' => [
                    [
                        'name' => 'Models e Migrations',
                        'description' => 'Criando models e gerenciando o banco de dados com migrations.',
                        'position' => 1,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Relacionamentos',
                        'description' => 'One-to-One, One-to-Many, Many-to-Many e relacionamentos polimórficos.',
                        'position' => 2,
                        'duration' => 3000, // 50 min
                    ],
                    [
                        'name' => 'Query Builder',
                        'description' => 'Construindo queries complexas com o Query Builder do Laravel.',
                        'position' => 3,
                        'duration' => 1800, // 30 min
                    ],
                ],
            ],

            // APIs REST com Laravel
            [
                'path_slug' => 'apis-rest-laravel',
                'modules' => [
                    [
                        'name' => 'Rotas de API',
                        'description' => 'Definindo rotas para APIs REST.',
                        'position' => 1,
                        'duration' => 1800, // 30 min
                    ],
                    [
                        'name' => 'Controllers e Resources',
                        'description' => 'Controllers de API e Eloquent Resources para serialização.',
                        'position' => 2,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Validação e Tratamento de Erros',
                        'description' => 'Validando dados e tratando erros em APIs.',
                        'position' => 3,
                        'duration' => 1200, // 20 min
                    ],
                ],
            ],

            // React Fundamentals
            [
                'path_slug' => 'react-fundamentals',
                'modules' => [
                    [
                        'name' => 'Componentes e JSX',
                        'description' => 'Criando componentes React com JSX.',
                        'position' => 1,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Props e State',
                        'description' => 'Gerenciando dados em componentes React.',
                        'position' => 2,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Eventos e Manipulação',
                        'description' => 'Lidando com eventos do usuário.',
                        'position' => 3,
                        'duration' => 1200, // 20 min
                    ],
                ],
            ],

            // Docker Básico
            [
                'path_slug' => 'docker-basico',
                'modules' => [
                    [
                        'name' => 'Conceitos Fundamentais',
                        'description' => 'O que são containers e como funcionam.',
                        'position' => 1,
                        'duration' => 1800, // 30 min
                    ],
                    [
                        'name' => 'Dockerfile e Imagens',
                        'description' => 'Criando imagens Docker personalizadas.',
                        'position' => 2,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Docker Compose',
                        'description' => 'Orquestrando múltiplos containers.',
                        'position' => 3,
                        'duration' => 1200, // 20 min
                    ],
                ],
            ],

            // Flutter Setup
            [
                'path_slug' => 'flutter-setup',
                'modules' => [
                    [
                        'name' => 'Instalação do Flutter',
                        'description' => 'Configurando o SDK Flutter no seu sistema.',
                        'position' => 1,
                        'duration' => 1800, // 30 min
                    ],
                    [
                        'name' => 'Primeiro App',
                        'description' => 'Criando seu primeiro aplicativo Flutter.',
                        'position' => 2,
                        'duration' => 1200, // 20 min
                    ],
                ],
            ],

            // Widgets Flutter
            [
                'path_slug' => 'widgets-flutter',
                'modules' => [
                    [
                        'name' => 'Widgets Básicos',
                        'description' => 'Text, Container, Row, Column e outros widgets fundamentais.',
                        'position' => 1,
                        'duration' => 3000, // 50 min
                    ],
                    [
                        'name' => 'Layout e Posicionamento',
                        'description' => 'Organizando widgets na tela.',
                        'position' => 2,
                        'duration' => 2400, // 40 min
                    ],
                    [
                        'name' => 'Widgets Customizados',
                        'description' => 'Criando seus próprios widgets.',
                        'position' => 3,
                        'duration' => 3000, // 50 min
                    ],
                ],
            ],
        ];

        foreach ($modules as $pathData) {
            $path = Path::where('slug', $pathData['path_slug'])->first();

            if ($path) {
                foreach ($pathData['modules'] as $moduleData) {
                    Module::firstOrCreate([
                        'path_id' => $path->id,
                        'name' => $moduleData['name'],
                    ], array_merge($moduleData, ['path_id' => $path->id]));
                }
            }
        }
    }
}
