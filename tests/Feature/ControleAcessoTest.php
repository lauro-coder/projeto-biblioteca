<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControleAcessoTest extends TestCase
{
    use RefreshDatabase;

    private Autor $autor;
    private Livro $livro;

    protected function setUp(): void
    {
        parent::setUp();

        $this->autor = Autor::create(['nome' => 'Machado de Assis', 'nacionalidade' => 'Brasileira']);
        $this->livro = Livro::create(['titulo' => 'Dom Casmurro', 'ano' => 1899, 'autor_id' => $this->autor->id]);
    }

    private function usuario(string $role): User
    {
        return User::factory()->create(['role' => $role]);
    }

    public function test_visitante_e_redirecionado_para_o_login(): void
    {
        $this->get('/livros')->assertRedirect('/login');
        $this->get('/autores')->assertRedirect('/login');
        $this->get('/admin/usuarios')->assertRedirect('/login');
    }

    public function test_todos_os_niveis_podem_ver_livros_e_autores(): void
    {
        foreach (['admin', 'bibliotecario', 'usuario'] as $role) {
            $user = $this->usuario($role);

            $this->actingAs($user)->get('/livros')->assertOk()->assertSee('Dom Casmurro');
            $this->actingAs($user)->get("/livros/{$this->livro->id}")->assertOk();
            $this->actingAs($user)->get("/autores/{$this->autor->id}")->assertOk()->assertSee('Dom Casmurro');
            $this->actingAs($user)->get('/dashboard')->assertOk();
        }
    }

    public function test_admin_abre_todas_as_telas_de_formulario(): void
    {
        $admin = $this->usuario('admin');
        $outro = $this->usuario('usuario');

        $this->actingAs($admin)->get('/livros/criar')->assertOk();
        $this->actingAs($admin)->get("/livros/{$this->livro->id}/editar")->assertOk()->assertSee('Dom Casmurro');
        $this->actingAs($admin)->get('/autores')->assertOk();
        $this->actingAs($admin)->get('/autores/criar')->assertOk();
        $this->actingAs($admin)->get("/autores/{$this->autor->id}/editar")->assertOk()->assertSee('Machado de Assis');
        $this->actingAs($admin)->get("/admin/usuarios/{$outro->id}/editar")->assertOk()->assertSee($outro->email);
        $this->actingAs($admin)->get('/dashboard')->assertOk()->assertSee('Gerenciar usuários');
    }

    public function test_usuario_comum_nao_pode_cadastrar_editar_nem_excluir(): void
    {
        $user = $this->usuario('usuario');

        $this->actingAs($user)->get('/livros/criar')->assertForbidden();
        $this->actingAs($user)->post('/livros', ['titulo' => 'Novo', 'autor_id' => $this->autor->id])->assertForbidden();
        $this->actingAs($user)->get("/livros/{$this->livro->id}/editar")->assertForbidden();
        $this->actingAs($user)->delete("/livros/{$this->livro->id}")->assertForbidden();

        $this->assertDatabaseHas('livros', ['id' => $this->livro->id]);
        $this->assertDatabaseMissing('livros', ['titulo' => 'Novo']);
    }

    public function test_bibliotecario_cadastra_e_edita_mas_nao_exclui(): void
    {
        $user = $this->usuario('bibliotecario');

        $this->actingAs($user)
            ->post('/livros', ['titulo' => 'Quincas Borba', 'ano' => 1891, 'autor_id' => $this->autor->id])
            ->assertRedirect('/livros');
        $this->assertDatabaseHas('livros', ['titulo' => 'Quincas Borba']);

        $this->actingAs($user)
            ->put("/livros/{$this->livro->id}", ['titulo' => 'Dom Casmurro (edicao nova)', 'ano' => 1899, 'autor_id' => $this->autor->id])
            ->assertRedirect("/livros/{$this->livro->id}");
        $this->assertDatabaseHas('livros', ['titulo' => 'Dom Casmurro (edicao nova)']);

        // a LivroPolicy bloqueia a exclusao para quem nao e admin
        $this->actingAs($user)->delete("/livros/{$this->livro->id}")->assertForbidden();
        $this->assertDatabaseHas('livros', ['id' => $this->livro->id]);
    }

    public function test_admin_pode_excluir_livro(): void
    {
        $this->actingAs($this->usuario('admin'))
            ->delete("/livros/{$this->livro->id}")
            ->assertRedirect('/livros');

        $this->assertDatabaseMissing('livros', ['id' => $this->livro->id]);
    }

    public function test_nao_exclui_autor_que_possui_livros(): void
    {
        $this->actingAs($this->usuario('admin'))
            ->delete("/autores/{$this->autor->id}")
            ->assertSessionHas('erro');

        $this->assertDatabaseHas('autores', ['id' => $this->autor->id]);
    }

    public function test_validacao_do_form_request_de_livro(): void
    {
        $this->actingAs($this->usuario('admin'))
            ->from('/livros/criar')
            ->post('/livros', ['titulo' => '', 'ano' => 'abc', 'autor_id' => 999])
            ->assertRedirect('/livros/criar')
            ->assertSessionHasErrors(['titulo', 'ano', 'autor_id']);
    }

    public function test_somente_admin_acessa_area_de_usuarios(): void
    {
        $this->actingAs($this->usuario('bibliotecario'))->get('/admin/usuarios')->assertForbidden();
        $this->actingAs($this->usuario('usuario'))->get('/admin/usuarios')->assertForbidden();
        $this->actingAs($this->usuario('admin'))->get('/admin/usuarios')->assertOk();
    }

    public function test_admin_altera_nivel_de_acesso_de_outro_usuario(): void
    {
        $admin = $this->usuario('admin');
        $outro = $this->usuario('usuario');

        $this->actingAs($admin)
            ->put("/admin/usuarios/{$outro->id}", ['role' => 'bibliotecario'])
            ->assertRedirect('/admin/usuarios');
        $this->assertSame('bibliotecario', $outro->fresh()->role);

        $this->actingAs($admin)
            ->put("/admin/usuarios/{$outro->id}", ['role' => 'superusuario'])
            ->assertSessionHasErrors('role');

        // nao pode mudar o proprio nivel
        $this->actingAs($admin)
            ->put("/admin/usuarios/{$admin->id}", ['role' => 'usuario'])
            ->assertSessionHas('erro');
        $this->assertSame('admin', $admin->fresh()->role);
    }

    public function test_novo_cadastro_recebe_nivel_usuario(): void
    {
        $this->post('/register', [
            'name' => 'Novo Leitor',
            'email' => 'leitor@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertSame('usuario', User::where('email', 'leitor@email.com')->first()->role);
    }

    public function test_seeders_criam_os_tres_niveis(): void
    {
        $this->seed();

        foreach (['admin@email.com' => 'admin', 'bibliotecario@email.com' => 'bibliotecario', 'usuario@email.com' => 'usuario'] as $email => $role) {
            $this->assertDatabaseHas('users', ['email' => $email, 'role' => $role]);
        }
    }
}
