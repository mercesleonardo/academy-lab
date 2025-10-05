# Academy Lab 🎓

Uma plataforma completa de ensino online construída com Laravel e Filament, oferecendo trilhas de aprendizado organizadas, integração com vídeos e chat com inteligência artificial para suporte aos estudantes.

## 📋 Sobre o Projeto

O Academy Laforma educacional moderna que permite:

- 🏗️ **Gestão Completa de Cursos**: Organização hierárquica com produtos, trilhas, módulos e aulas
- 🎥 **Integração com Panda Video**: Player de vídeo profissional com controle de progresso
- 🤖 **Chat com IA**: Assistente inteligente para tirar dúvidas sobre as aulas
- 👥 **Gestão de Usuários**: Sistema completo de membros e administradores
- 📊 **Acompanhamento de Progresso**: Controle detalhado do progresso dos estudantes
- 🔗 **Integração Eduzz**: Webhook para gestão automática de acessos

## 🚀 Tecnologias Utilizadas

### Backend
- **Laravel 12** - Framework PHP moderno
- **Filament 4** - Painel administrativo com interface elegante
- **Livewire 3** - Framework para interfaces reativas
- **Laravel Sanctum** - Autenticação de API
- **SQLite** - Banco de dados (configurável para MySQL/PostgreSQL)

### Frontend
- **Tailwind CSS 4** - Framework CSS utilitário
- **Alpine.js** - Framework JavaScript reativo
- **Vite** - Build tool moderno
- **Blade** - Template engine do Laravel

### Integrações
- **Panda Video** - Plataforma de vídeos com player profissional
- **Eduzz** - Gateway de pagamento e gestão de produtos
- **AWS S3** - Armazenamento de arquivos (opcional)
## 🏗️ Arquitetura do Sistema

### Estrutura Hierárquica
```
Product (Produto)
├── Track (Trilha)
│   └── Path (Caminho)
│       └── Module (Módulo)
│           └── Lesson (Aula)
│               ├── LessonMaterial (Materiais)
│               ├── Comment (Comentários)
│               └── Rating (Avaliações)
```

### Painéis do Sistema
- **Admin Panel** (`/admin`) - Gestão completa do sistema
- **Member Panel** (`/`) - Área do estudante

### Modelos Principais
- **User** - Usuários do sistema (administradores e membros)
- **Product** - Produtos/cursos oferecidos
- **Track** - Trilhas de aprendizado
- **Path** - Caminhos dentro das trilhas
- **Module** - Módulos organizacionais
- **Lesson** - Aulas individuais com vídeos
- **LessonStatus** - Controle de progresso dos estudantes
- **Message** - Sistema de chat com IA

## 🛠️ Instalação e Configuração

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js 18+
- NPM/Yarn

### Passo a Passo

1. **Clone o repositório**
```bash
git clone https://github.com/beerandcodeteam/academy-lab.git
cd academy-lab
```

2. **Instale as dependências**
```bash
composer install
npm install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**
```bash
touch database/database.sqlite
php artisan migrate --seed
```

5. **Compile os assets**
```bash
npm run build
# ou para desenvolvimento
npm run dev
```

6. **Inicie o servidor**
```bash
php artisan serve
```

### Variáveis de Ambiente Importantes

```env
# Panda Video
PANDA_VIDEO_API_KEY=sua_chave_api_panda

# Eduzz Webhook
EDUZZ_SECRET_KEY=sua_chave_secreta_eduzz

# AWS S3 (opcional)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
```

## 👨‍💼 Funcionalidades Administrativas

### Painel Admin (`/admin`)
- **Gestão de Usuários**: CRUD completo de membros e administradores
- **Gestão de Produtos**: Criação e configuração de cursos
- **Gestão de Trilhas**: Organização de conteúdo em trilhas
- **Gestão de Módulos**: Estruturação de módulos dentro das trilhas
- **Gestão de Aulas**: Upload e configuração de vídeos via Panda
- **Materiais de Apoio**: Upload de PDFs, documentos e links
- **Relatórios de Progresso**: Acompanhamento detalhado dos estudantes

### Recursos do Filament
- Interface moderna e responsiva
- Filtros e busca avançada
- Exportação de dados
- Relacionamentos automatizados
- Validação de formulários
- Notificações em tempo real

## 👨‍🎓 Área do Estudante

### Funcionalidades Principais
- **Dashboard**: Visão geral dos cursos e progresso
- **Sala de Aula**: Player de vídeo integrado com controle de progresso
- **Chat com IA**: Assistente para tirar dúvidas sobre as aulas
- **Materiais de Apoio**: Download de arquivos complementares
- **Sistema de Avaliações**: Rating e comentários das aulas
- **Controle de Progresso**: Acompanhamento automático do andamento

### Player de Vídeo
- Integração completa com Panda Video
- Controle automático de progresso
- Prevenção de pulos (opcional)
- Qualidade adaptativa
- Compatibilidade mobile

## 🤖 Sistema de Chat com IA

### Características
- Chat contextual por aula
- Integração com N8N para processamento
- Histórico de conversas persistente
- Interface em tempo real com Livewire
- Suporte a múltiplas sessões

### Componentes
- **ChatAgent**: Chat específico por aula
- **GlobalChat**: Chat geral da plataforma
- **Message Model**: Armazenamento de conversas

## 🔧 Comandos Artisan Customizados

```bash
# Download de vídeos do Panda
php artisan panda:download

# Outros comandos padrão do Laravel
php artisan migrate
php artisan db:seed
php artisan queue:work
```

## 📊 Integração com Eduzz

### Webhook de Pagamentos
- Verificação automática de assinatura HMAC
- Criação automática de usuários
- Gestão de acessos por produto
- Controle de validade de assinatura

### Fluxo de Integração
1. Cliente compra na Eduzz
2. Webhook enviado para `/api/eduzz/webhook`
3. Verificação de autenticidade
4. Criação/atualização de usuário
5. Vinculação com produto adquirido

## 📁 Estrutura de Arquivos Principais

```
app/
├── Filament/
│   ├── Admin/          # Painel administrativo
│   └── Member/         # Painel do estudante
├── Http/
│   ├── Controllers/    # Controladores
│   └── Requests/       # Form Requests
├── Livewire/          # Componentes Livewire
├── Models/            # Modelos Eloquent
├── Policies/          # Políticas de autorização
└── Services/          # Serviços (PandaServices)

resources/
├── views/             # Templates Blade
├── js/                # JavaScript (Alpine components)
├── css/               # Estilos
└── flows/             # Fluxos N8N

config/
├── filament.php       # Configuração Filament
├── panda.php          # Configuração Panda Video
└── eduzz.php          # Configuração Eduzz
```

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes específicos
php artisan test --filter=UserTest

# Com coverage
php artisan test --coverage
```

## 📝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🆘 Suporte

Para suporte e dúvidas:
- 📧 Email: [contato@beerandcode.team](mailto:contato@beerandcode.team)
- 🐛 Issues: [GitHub Issues](https://github.com/beerandcodeteam/academy-lab/issues)

---

Desenvolvido com ❤️ pela equipe [Beer & Code](https://github.com/beerandcodeteam)

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
