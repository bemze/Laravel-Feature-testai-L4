<?php

namespace Tests\Unit;
use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;



class ManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tool_can_be_created_with_name_and_task_only() {
        // given
        $toolData = ['name' => "Jonas", 'task' => 'Ismokti Unit testing' ];
        // when
        Tool::firstOrCreate($toolData);
        // then
        $tools = Tool::all();
        $this->assertEquals(1, $tools->count());
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $tools);
        }
}
