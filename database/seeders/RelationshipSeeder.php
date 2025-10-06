<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Track;
use App\Models\Path;
use App\Models\ProductTrack;
use App\Models\ProductTrackPath;
use App\Models\User;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedProductTracks();
        $this->seedProductTrackPaths();
        $this->seedUserProducts();
    }

    private function seedProductTracks(): void
    {
        $relationships = [
            // Curso Completo de Laravel
            [
                'product_name' => 'Curso Completo de Laravel',
                'tracks' => [
                    ['track_name' => 'Fundamentos do Laravel', 'position' => 1],
                    ['track_name' => 'Laravel Avançado', 'position' => 2],
                ],
            ],

            // Desenvolvimento Frontend Moderno
            [
                'product_name' => 'Desenvolvimento Frontend Moderno',
                'tracks' => [
                    ['track_name' => 'Frontend com React', 'position' => 1],
                    ['track_name' => 'Vue.js Essencial', 'position' => 2],
                    ['track_name' => 'TypeScript para Desenvolvedores', 'position' => 3],
                ],
            ],

            // DevOps e Cloud Computing
            [
                'product_name' => 'DevOps e Cloud Computing',
                'tracks' => [
                    ['track_name' => 'Docker e Containers', 'position' => 1],
                    ['track_name' => 'AWS Fundamentals', 'position' => 2],
                    ['track_name' => 'CI/CD com GitHub Actions', 'position' => 3],
                ],
            ],

            // Banco de Dados Avançado
            [
                'product_name' => 'Banco de Dados Avançado',
                'tracks' => [
                    ['track_name' => 'MySQL Avançado', 'position' => 1],
                    ['track_name' => 'PostgreSQL Professional', 'position' => 2],
                ],
            ],

            // Mobile Development com Flutter
            [
                'product_name' => 'Mobile Development com Flutter',
                'tracks' => [
                    ['track_name' => 'Dart Language', 'position' => 1],
                    ['track_name' => 'Flutter Básico', 'position' => 2],
                    ['track_name' => 'Flutter Avançado', 'position' => 3],
                ],
            ],
        ];

        foreach ($relationships as $productData) {
            $product = Product::where('name', $productData['product_name'])->first();

            if ($product) {
                foreach ($productData['tracks'] as $trackData) {
                    $track = Track::where('name', $trackData['track_name'])->first();

                    if ($track) {
                        ProductTrack::firstOrCreate([
                            'product_id' => $product->id,
                            'track_id' => $track->id,
                        ], [
                            'position' => $trackData['position'],
                            'visibility' => 'visible',
                        ]);
                    }
                }
            }
        }
    }

    private function seedProductTrackPaths(): void
    {
        $relationships = [
            // Fundamentos do Laravel
            [
                'track_name' => 'Fundamentos do Laravel',
                'paths' => [
                    ['path_slug' => 'introducao-laravel', 'position' => 1],
                    ['path_slug' => 'eloquent-orm', 'position' => 2],
                    ['path_slug' => 'autenticacao-autorizacao', 'position' => 3],
                ],
            ],

            // Laravel Avançado
            [
                'track_name' => 'Laravel Avançado',
                'paths' => [
                    ['path_slug' => 'apis-rest-laravel', 'position' => 1],
                ],
            ],

            // Frontend com React
            [
                'track_name' => 'Frontend com React',
                'paths' => [
                    ['path_slug' => 'react-fundamentals', 'position' => 1],
                    ['path_slug' => 'react-hooks', 'position' => 2],
                ],
            ],

            // Vue.js Essencial
            [
                'track_name' => 'Vue.js Essencial',
                'paths' => [
                    ['path_slug' => 'vuejs-basico', 'position' => 1],
                ],
            ],

            // TypeScript para Desenvolvedores
            [
                'track_name' => 'TypeScript para Desenvolvedores',
                'paths' => [
                    ['path_slug' => 'typescript-essentials', 'position' => 1],
                ],
            ],

            // Docker e Containers
            [
                'track_name' => 'Docker e Containers',
                'paths' => [
                    ['path_slug' => 'docker-basico', 'position' => 1],
                ],
            ],

            // AWS Fundamentals
            [
                'track_name' => 'AWS Fundamentals',
                'paths' => [
                    ['path_slug' => 'aws-ec2-rds', 'position' => 1],
                ],
            ],

            // CI/CD com GitHub Actions
            [
                'track_name' => 'CI/CD com GitHub Actions',
                'paths' => [
                    ['path_slug' => 'cicd-pipeline', 'position' => 1],
                ],
            ],

            // MySQL Avançado
            [
                'track_name' => 'MySQL Avançado',
                'paths' => [
                    ['path_slug' => 'otimizacao-mysql', 'position' => 1],
                ],
            ],

            // PostgreSQL Professional
            [
                'track_name' => 'PostgreSQL Professional',
                'paths' => [
                    ['path_slug' => 'postgresql-avancado', 'position' => 1],
                ],
            ],

            // Flutter Básico
            [
                'track_name' => 'Flutter Básico',
                'paths' => [
                    ['path_slug' => 'flutter-setup', 'position' => 1],
                    ['path_slug' => 'widgets-flutter', 'position' => 2],
                ],
            ],

            // Flutter Avançado
            [
                'track_name' => 'Flutter Avançado',
                'paths' => [
                    ['path_slug' => 'state-management-flutter', 'position' => 1],
                ],
            ],
        ];

        foreach ($relationships as $trackData) {
            $track = Track::where('name', $trackData['track_name'])->first();

            if ($track) {
                $productTracks = ProductTrack::where('track_id', $track->id)->get();

                foreach ($productTracks as $productTrack) {
                    foreach ($trackData['paths'] as $pathData) {
                        $path = Path::where('slug', $pathData['path_slug'])->first();

                        if ($path) {
                            ProductTrackPath::firstOrCreate([
                                'product_track_id' => $productTrack->id,
                                'path_id' => $path->id,
                            ], [
                                'position' => $pathData['position'],
                                'visibility' => 'visible',
                            ]);
                        }
                    }
                }
            }
        }
    }

    private function seedUserProducts(): void
    {
        $products = Product::all();
        $members = User::where('role_id', 2)->take(10)->get(); // Pega os primeiros 10 members

        foreach ($members as $member) {
            // Cada member terá acesso a 1-3 produtos aleatórios
            $memberProducts = $products->random(rand(1, 3));

            foreach ($memberProducts as $product) {
                $member->products()->syncWithoutDetaching([
                    $product->id => [
                        'starts_at' => now(),
                        'expires_at' => now()->addYear(), // Acesso por 1 ano
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ]);
            }
        }
    }
}
