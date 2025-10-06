<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Curso Completo de Laravel',
                'eduzz_id' => 'EDZ001',
                'slug' => 'curso-completo-laravel',
                'description' => 'Aprenda Laravel do básico ao avançado com projetos práticos e reais. Desenvolva aplicações web modernas e robustas.',
                'cover' => 'laravel-course-cover.jpg',
                'redirect_url' => null,
                'featured' => true,
                'position' => 1,
            ],
            [
                'name' => 'Desenvolvimento Frontend Moderno',
                'eduzz_id' => 'EDZ002',
                'slug' => 'desenvolvimento-frontend-moderno',
                'description' => 'Domine as tecnologias mais atuais do frontend: React, Vue.js, TypeScript e muito mais.',
                'cover' => 'frontend-course-cover.jpg',
                'redirect_url' => null,
                'featured' => true,
                'position' => 2,
            ],
            [
                'name' => 'DevOps e Cloud Computing',
                'eduzz_id' => 'EDZ003',
                'slug' => 'devops-cloud-computing',
                'description' => 'Aprenda a configurar pipelines CI/CD, trabalhar com containers Docker e deploy em AWS.',
                'cover' => 'devops-course-cover.jpg',
                'redirect_url' => null,
                'featured' => false,
                'position' => 3,
            ],
            [
                'name' => 'Banco de Dados Avançado',
                'eduzz_id' => 'EDZ004',
                'slug' => 'banco-dados-avancado',
                'description' => 'Otimização de queries, modelagem avançada e administração de bancos de dados.',
                'cover' => 'database-course-cover.jpg',
                'redirect_url' => null,
                'featured' => false,
                'position' => 4,
            ],
            [
                'name' => 'Mobile Development com Flutter',
                'eduzz_id' => 'EDZ005',
                'slug' => 'mobile-development-flutter',
                'description' => 'Desenvolva aplicativos nativos para iOS e Android usando Flutter e Dart.',
                'cover' => 'flutter-course-cover.jpg',
                'redirect_url' => null,
                'featured' => true,
                'position' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['eduzz_id' => $product['eduzz_id']],
                $product
            );
        }
    }
}
