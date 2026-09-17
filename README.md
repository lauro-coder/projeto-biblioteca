# Biblioteca

Sistema web de controle de uma biblioteca, desenvolvido com Laravel como projeto final da disciplina.

## Integrantes

| Integrante | Atividades realizadas |
|---|---|
| Lauro Santos ([@lauro-coder](https://github.com/lauro-coder)) | Criação do projeto e instalação do Laravel Breeze; campo `role` na tabela `users`; middleware `CheckRole` e seu alias; models e migrations de `Autor` e `Livro`; CRUD inicial de livros (listar, cadastrar, editar e excluir); seeders de autores e livros; restrição das telas por nível de acesso. |
| EJSeguro ([@EJSeguro](https://github.com/EJSeguro)) | Seeder de usuários para os três níveis; Form Requests (`LivroRequest`, `AutorRequest`, `UpdateUserRoleRequest`); Policies (`LivroPolicy`, `AutorPolicy`) e tela de visualização de livros; CRUD de autores com a listagem dos livros de cada autor; área administrativa de usuários; menu de navegação, dashboard e página inicial; testes automatizados; README. |

## Descrição

O sistema permite cadastrar **autores** e **livros**. Cada autor possui vários livros (relacionamento `hasMany` / `belongsTo` com Eloquent). O acesso é feito com login (Laravel Breeze), e o que cada pessoa pode fazer depende do seu nível de acesso: **admin**, **bibliotecário** ou **usuário**.

### Funcionalidades

- Cadastro, login e logout de usuários (Laravel Breeze)
- CRUD completo de **livros**: listar, visualizar, cadastrar, editar e excluir
- CRUD completo de **autores**, com a página do autor listando os seus livros
- Dashboard com totais e os últimos livros cadastrados
- Área administrativa (`/admin/usuarios`) para alterar o nível de acesso e excluir usuários
- Mensagens de sucesso, de erro e de validação nos formulários

### Controle de acesso

| Funcionalidade | Admin | Bibliotecário | Usuário |
|---|:---:|:---:|:---:|
| Visualizar livros e autores | ✅ | ✅ | ✅ |
| Cadastrar livros e autores | ✅ | ✅ | ❌ |
| Editar livros e autores | ✅ | ✅ | ❌ |
| Excluir livros e autores | ✅ | ❌ | ❌ |
| Gerenciar usuários | ✅ | ❌ | ❌ |

Quem cria uma conta pela tela de cadastro recebe o nível **usuário**. Só o admin pode alterar o nível de acesso.

### Onde cada recurso do Laravel é usado

| Recurso | Arquivos |
|---|---|
| Models | `app/Models/Livro.php`, `app/Models/Autor.php`, `app/Models/User.php` |
| Controllers | `LivroController`, `AutorController`, `DashboardController`, `Admin/UserController` |
| Views (Blade) | `resources/views/livros`, `resources/views/autores`, `resources/views/admin/usuarios`, `resources/views/dashboard.blade.php` |
| Migrations | `database/migrations` (`users` com `role`, `autores`, `livros` com a chave estrangeira `autor_id`) |
| Seeders | `UserSeeder`, `AutorSeeder`, `LivroSeeder` |
| Relacionamento | `Autor::livros()` (hasMany) e `Livro::autor()` (belongsTo) |
| Middleware | `app/Http/Middleware/CheckRole.php`, registrado como `role` em `bootstrap/app.php` e aplicado às rotas de cadastro/edição (`role:admin,bibliotecario`) e à área `/admin` (`role:admin`) |
| Policies | `app/Policies/LivroPolicy.php` e `app/Policies/AutorPolicy.php`, usadas nos controllers (`Gate::authorize`) e nas views (`@can`). Só o admin pode excluir |
| Form Requests | `app/Http/Requests/LivroRequest.php`, `AutorRequest.php`, `UpdateUserRoleRequest.php` |

### Rotas principais

| Rota | Descrição |
|---|---|
| `/livros` | Lista de livros |
| `/livros/criar` | Cadastro de livro |
| `/livros/{id}` | Detalhes do livro |
| `/livros/{id}/editar` | Edição de livro |
| `/autores` | Lista de autores |
| `/autores/criar` | Cadastro de autor |
| `/autores/{id}` | Detalhes do autor e os seus livros |
| `/autores/{id}/editar` | Edição de autor |
| `/admin/usuarios` | Gerenciamento de usuários (somente admin) |

## Tecnologias utilizadas

- PHP 8.3+
- Laravel 13
- Laravel Breeze (Blade)
- Blade
- Tailwind CSS e Vite
- SQLite (padrão do `.env.example`; também funciona com MySQL ou PostgreSQL)

## Instalação

Pré-requisitos: PHP 8.3+, Composer e Node.js.

```bash
git clone https://github.com/lauro-coder/projeto-biblioteca.git
cd projeto-biblioteca

composer install
cp .env.example .env
php artisan key:generate

npm install
npm run build
```

O `.env.example` usa SQLite. Crie o arquivo do banco antes de rodar as migrations:

```bash
touch database/database.sqlite
```

No Windows (PowerShell): `New-Item database/database.sqlite`.

Para usar MySQL ou PostgreSQL, ajuste `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` no `.env`.

Crie as tabelas e os dados de teste:

```bash
php artisan migrate:fresh --seed
```

## Execução

```bash
php artisan serve
```

Acesse http://localhost:8000.

Durante o desenvolvimento, dá para usar `npm run dev` em outro terminal no lugar do `npm run build`.

Para rodar os testes automatizados:

```bash
php artisan test
```

## Usuários para teste

Criados pelo `UserSeeder`:

| Nível | E-mail | Senha |
|---|---|---|
| Administrador | admin@email.com | 12345678 |
| Bibliotecário | bibliotecario@email.com | 12345678 |
| Usuário | usuario@email.com | 12345678 |
