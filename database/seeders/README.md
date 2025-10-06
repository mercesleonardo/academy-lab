# Seeders do Academy Lab

Este documento explica como usar os seeders criados para popular o banco de dados do Academy Lab com dados de demonstração.

## 📋 Seeders Disponíveis

### 1. **RoleSeeder**
- Cria os roles básicos: `admin` e `member`
- Define IDs fixos: 1 (admin) e 2 (member)

### 2. **UserSeeder**
- Cria um usuário administrador padrão
- Cria 5 usuários membros com dados realistas
- Cria 15 usuários membros adicionais usando factory
- **Admin padrão**: `admin@academy-lab.com` / `password`

### 3. **MaterialTypeSeeder**
- Cria tipos de materiais de apoio:
  - PDF, Documento, Apresentação, Planilha
  - Link, Código, Imagem, Áudio
  - Exercício, Quiz

### 4. **ProductSeeder**
- Cria 5 produtos/cursos de exemplo:
  - Curso Completo de Laravel
  - Desenvolvimento Frontend Moderno
  - DevOps e Cloud Computing
  - Banco de Dados Avançado
  - Mobile Development com Flutter

### 5. **TrackSeeder**
- Cria 13 trilhas de aprendizado
- Abrange temas de Laravel, Frontend, DevOps, Database e Mobile

### 6. **PathSeeder**
- Cria 16 caminhos organizados por área
- Cada path tem duração e descrição específica

### 7. **ModuleSeeder**
- Cria módulos para os paths principais
- Relaciona módulos com seus respectivos paths

### 8. **LessonSeeder**
- Cria aulas para os módulos
- Inclui duração, posição e descrição para cada aula
- Gera slugs automaticamente

### 9. **LessonMaterialSeeder**
- Cria materiais de apoio para as aulas
- Inclui links, códigos, PDFs e exercícios

### 10. **RelationshipSeeder**
- Relaciona produtos com trilhas
- Relaciona trilhas com caminhos
- Atribui produtos aos usuários membros

## 🚀 Como Executar

### Executar Todos os Seeders
```bash
php artisan db:seed
```

### Executar Seeder Específico
```bash
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ProductSeeder
# etc...
```

### Resetar e Popular Novamente
```bash
php artisan migrate:fresh --seed
```

## 📊 Dados Criados

Após executar todos os seeders, você terá:

- **1** usuário admin + **20** usuários membros
- **5** produtos/cursos
- **13** trilhas
- **16** caminhos
- **~25** módulos
- **~50** aulas
- **~30** materiais de apoio
- **10** tipos de materiais

## 👤 Usuários de Teste

### Administrador
- **Email**: `admin@academy-lab.com`
- **Senha**: `password`
- **Role**: Admin

### Membros Principais
- **João Silva**: `joao@example.com`
- **Maria Santos**: `maria@example.com`
- **Pedro Oliveira**: `pedro@example.com`
- **Ana Costa**: `ana@example.com`
- **Carlos Ferreira**: `carlos@example.com`
- **Senha**: `password` (para todos)

## 🏗️ Estrutura Hierárquica Criada

```
Produtos (5)
├── Trilhas (13)
│   └── Caminhos (16)
│       └── Módulos (~25)
│           └── Aulas (~50)
│               └── Materiais (~30)
```

## 📝 Personalização

### Modificar Dados
Para personalizar os dados, edite os arrays dentro de cada seeder:

```php
// Exemplo no ProductSeeder.php
$products = [
    [
        'name' => 'Seu Curso Personalizado',
        'eduzz_id' => 'SEU_ID',
        'slug' => 'seu-curso-personalizado',
        'description' => 'Descrição do seu curso...',
        // ...
    ],
];
```

### Adicionar Novos Seeders
1. Crie o seeder: `php artisan make:seeder NovoSeeder`
2. Implemente a lógica no método `run()`
3. Adicione no `DatabaseSeeder.php`:

```php
$this->call([
    // seeders existentes...
    NovoSeeder::class,
]);
```

## ⚠️ Observações Importantes

1. **IDs do Panda Video**: As aulas são criadas sem `panda_id` real. Em produção, você precisará configurar IDs válidos do Panda Video.

2. **Arquivos de Material**: Os caminhos de arquivos são placeholders. Em produção, você precisará fazer upload dos arquivos reais.

3. **Performance**: Para grandes volumes de dados, considere usar `DB::table()->insert()` em vez de Eloquent para melhor performance.

4. **Relacionamentos**: O `RelationshipSeeder` deve ser executado por último, pois depende dos outros seeders.

## 🔧 Troubleshooting

### Erro de Foreign Key
Se ocorrer erro de chave estrangeira, verifique se:
- As migrations foram executadas
- Os seeders são executados na ordem correta
- Os dados referenciados existem

### Dados Duplicados
Os seeders usam `firstOrCreate()` para evitar duplicação. Se quiser forçar recriação:
```bash
php artisan migrate:fresh --seed
```

### Debugging
Para debug, adicione logs nos seeders:
```php
\Log::info('Criando produto: ' . $product['name']);
```
