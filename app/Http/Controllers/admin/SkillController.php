<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Events\SkillAddedEvent;
use App\Events\SkillToggleEvent;
use App\Events\SkillDeletedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $data['cats'] = Cat::select('id', 'name')->get();
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        return view('admin.skills.index')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id'
        ]);
        $path = Storage::putFile('skills', $request->file('img'));
        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,

        ]);
        $request->session()->flash('msg', 'row added successfully');
        event(new SkillAddedEvent("$request->name_en Skill Added Successfuly"));
        return back();
    }
    public function delete(Request $request, Skill $skill)
    {
        try {
            $path = $skill->img;
            $skill->delete();
            Storage::delete($path);
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = "row can't br deleted";
        }
        $request->session()->flash('msg', $msg);
        $skillName = $skill->name('en');
        event(new SkillDeletedEvent("$skillName Skill was Deleted"));
        return  back();
    }

    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active,
        ]);
        $skillName = $skill->name('en');
        event(new SkillToggleEvent("$skillName Skill's status changed"));
        return back();
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'cat_id' => 'required|exists:cats,id',
            'img' => 'nullable|image|max:2048'
        ]);
        $skill = Cat::findOrFail($request->id);
        $path = $skill->img;
        if ($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile('skills', $request->file('img'));
        }
        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }
}
