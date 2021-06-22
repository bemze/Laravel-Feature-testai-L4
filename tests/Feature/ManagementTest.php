<?php

namespace Tests\Feature;

use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function task_can_be_added()
    {
        // given
        $this->withoutExceptionHandling();
        $toolData = ['name' => "Jonas", 'task' => 'Ismokti Unit testing'];
        // var_dump(Tool::all());
        // fwrite(STDOUT, $_ENV['MANTAS_OPTION']);

        //when
        $response = $this->post('/tools', $toolData);

        // then
        $response->assertStatus(302);
        $tools = Tool::all();
        $this->assertCount(1, $tools);

        // testavimo konteksto config isspausdinimas
        // fwrite(STDOUT, env('CACHE_DRIVER'));
        // visi
        // print_r($_ENV);
    }
    /**
     * @test 
     */
    // pirmas validation budas su exeptionais
    public function name_required_to_create_task()
    {
        // given
        $this->withoutExceptionHandling();
        $toolData = ['name' => "", 'task' => 'Ismokti Unit testing'];
        //when // then
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');
        $this->post('/tools', $toolData);
    }
    /**
     * @test
     */
    // antras validation budas su assertionais
    public function name_required_to_create_task_with_assertions()
    {

        // given
        $toolData = ['name' => "", 'task' => 'Ismokti Unit testing'];
        //when
        $response = $this->post('/tools', $toolData);

        // then
        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
        // patikrina, ar netinkmi duomenys neissisaugojo DB
        $this->assertCount(0, Tool::all());
    }
    /**
     * @test
     */
    public function task_can_be_updated()
    {

        // given
        // $this->withoutExceptionHandling();
        $toolData = ['name' => "Jonas", 'task' => 'Ismokti Unit testing'];
        $this->post('/tools', $toolData);
        //when

        $updateToolData = ['name' => "Jonas", 'task' => 'atnaujinimas'];
        $response = $this->put('/tools/' . $updateToolData['name'], $updateToolData);

        // then
        $response->assertStatus(302);
        $tools = Tool::all();
        // var_dump(Tool::all());
        $this->assertCount(1, $tools);
        // $this->assertEquals($updateToolData['name'], Tool::first()->name);
        $this->assertEquals($updateToolData['task'], Tool::first()->task);
    }
    /**
     * @test
     */
    public function task_can_be_deleted()
    {
        // given
        $this->withoutExceptionHandling();
        $toolData = ['name' => "Jonas", 'task' => 'Ismokti Unit testing'];
        $this->post('/tools', $toolData);
        // when
        
        $this->assertCount(1, Tool::all()); // optional, we have already proved that this works above
        $response = $this->delete('/tools/' . $toolData['name']);
        // then
        // $response->assertStatus(200);

        $this->assertCount(0, Tool::all());
        $response->assertRedirect('/tools/');
    }
}
