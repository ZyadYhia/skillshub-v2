<?php

namespace App\Http\Controllers\web;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function show($id)
    {
        $data['skill']=Skill::active()->findOrFail($id);
        return view('web.skills.show')->with($data);
    }
}
