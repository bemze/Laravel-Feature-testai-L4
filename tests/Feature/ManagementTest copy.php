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
        //when
        $response = $this->post('/tools', $toolData);

        // then

        $response->assertStatus(200);
        $tools = Tool::all();
        $this->assertCount(1, $tools);
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

        $response = $this->post('/tools', $toolData);
    }
    /**
     * @test
     */
    // antras validation budas su assertionais
    public function name_required_to_create_task2()
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
    // public function task_can_be_updated()
    // {

    //     // given
    //     $this->withoutExceptionHandling();
    //     $toolData = ['name' => "Jonas", 'task' => 'Ismokti Unit testing'];
    //     $this->post('/tools', $toolData);
    //     //when
    //     $updateToolData = ['name' => "Jonas", 'task' => 'atnaujinimas'];
    //     $response = $this->put('/tools/' . $updateToolData['name'], $updateToolData);

    //     // then

    //     $response->assertStatus(200);
    //     $tools = Tool::all();
    //     $this->assertCount(1, $tools);
    //     $this->assertEquals($updateToolData['name'], Tool::first()->name);
    //     $this->assertEquals($updateToolData['task'], Tool::first()->task);
    // }
}
