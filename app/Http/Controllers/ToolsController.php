<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolsController extends Controller
{
    public function store()
    {
        // $data = request()->validate(['name' => 'required', 'task' => 'required']);
        $tool = Tool::create($this->validateRequest());
        return redirect('/tools/'.$tool->name);
        // Tool::create($data);
    }
    public function update(Tool $tool)
    {
        // $data = request()->validate(['name' => 'required', 'task' => 'required']);
        $tool->update($this->validateRequest());
        return redirect('/tools/'.$tool->name);
    }
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect('/tools');
    }
    private function validateRequest()
    {
        return request()->validate(['name' => 'required', 'task' => 'required']);
    }
}
