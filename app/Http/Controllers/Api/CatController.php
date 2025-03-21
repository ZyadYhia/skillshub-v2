<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::orderBy('id', 'DESC')->get();
        return CatResource::collection($cats);
    }
    public function show($id)
    {
        $cat = Cat::with('skills')->findOrFail($id);
        return new CatResource($cat);
    }
}
