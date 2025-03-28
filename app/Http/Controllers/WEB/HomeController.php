<?php

namespace App\Http\Controllers\WEB;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $cats = Cat::active()->get();
        $skills = Skill::active()->get();
        $data['cats'] = $cats;
        $data['skills'] = $skills;
        return view('web.home.index', $data);
    }
}
