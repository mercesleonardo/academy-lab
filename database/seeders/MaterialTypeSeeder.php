<?php

namespace Database\Seeders;

use App\Models\MaterialType;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materialTypes = [
            ['name' => 'PDF'],
            ['name' => 'Documento'],
            ['name' => 'Apresentação'],
            ['name' => 'Planilha'],
            ['name' => 'Link'],
            ['name' => 'Código'],
            ['name' => 'Imagem'],
            ['name' => 'Áudio'],
            ['name' => 'Exercício'],
            ['name' => 'Quiz'],
        ];

        foreach ($materialTypes as $type) {
            MaterialType::firstOrCreate($type);
        }
    }
}
