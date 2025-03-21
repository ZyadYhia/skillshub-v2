<?php

namespace App\Http\Controllers\WEB;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $cats = Cat::active()->select('id', 'name')->get();
        $skills = Cat::active()->select('id', 'name')->get();
        $data['cats'] = $cats;
        $data['skills'] = $skills;
        return view('web.home.index', $data);
    }
}
