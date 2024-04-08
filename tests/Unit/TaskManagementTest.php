<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Arr;

use App\Models\Tasks;

class TaskManagementTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste para criação de uma nova tarefa.
     *
     * @return void
     */
    public function testCreateTask()
    {
        // Criar um usuário para autenticar
        $user = User::factory()->create();

        // Autenticar o usuário
        $this->actingAs($user);

        // Dados da nova tarefa
        $taskData = [
            'title' =>'tarefa Unit 1',
            'description'=>'descricao Unit 1',
            'initialDate' =>'2024-04-06',
            'expectedFinalDate'=>'2024-04-08',
            'user_id'=>"['4','5','6']"
        ];

        // Enviar uma requisição POST para criar a tarefa
        $response = $this->post('/tasks', $taskData);

        // Verificar se a tarefa foi criada com sucesso
        $response->assertStatus(200);
        Arr::forget($taskData, 'user_id');
        // Verificar se a tarefa está no banco de dados
        $this->assertDatabaseHas('tasks', $taskData);
    }
}
