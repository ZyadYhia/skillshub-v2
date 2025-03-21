<?php

namespace App\Http\Controllers\web;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function show($id)
    {
        $data['cat']=Cat::active()->findOrFail($id);
        $data['all_cats']=Cat::active()->select('id','name')->get();
        $data['skills']=$data['cat']->skills()->active()->paginate(6);
        return  view('web.cats.show')->with($data);
    }
}
