<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@academy-lab.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@academy-lab.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // admin
                'avatar' => null,
                'document' => '12345678901',
                'phone' => '(11) 99999-9999',
            ]
        );

        // Test member users
        $members = [
            [
                'name' => 'João Silva',
                'email' => 'joao@example.com',
                'document' => '12345678900',
                'phone' => '(11) 98888-8888',
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria@example.com',
                'document' => '98765432100',
                'phone' => '(11) 97777-7777',
            ],
            [
                'name' => 'Pedro Oliveira',
                'email' => 'pedro@example.com',
                'document' => '11122233344',
                'phone' => '(11) 96666-6666',
            ],
            [
                'name' => 'Ana Costa',
                'email' => 'ana@example.com',
                'document' => '55566677788',
                'phone' => '(11) 95555-5555',
            ],
            [
                'name' => 'Carlos Ferreira',
                'email' => 'carlos@example.com',
                'document' => '99988877766',
                'phone' => '(11) 94444-4444',
            ],
        ];

        foreach ($members as $member) {
            User::firstOrCreate(
                ['email' => $member['email']],
                array_merge($member, [
                    'password' => Hash::make('password'),
                    'role_id' => 2, // member
                    'avatar' => null,
                ])
            );
        }

        // Create additional random members using factory
        User::factory(15)->create([
            'role_id' => 2, // member
        ]);
    }
}
