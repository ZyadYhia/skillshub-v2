<?php

namespace App\Http\Controllers;

use Exception;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = User::role(['superadmin', 'admin'])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.admins.index')->with($data);
    }
    public function create()
    {
        $data['roles'] = Role::all();
        return view('admin.admins.create')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:25|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect(url("dashboard/admins"));
    }
    public function promote($id)
    {
        $admin = User::findOrFail($id);
        $admin->update([
            'role_id' => Role::select('id')->where('name', 'superadmin')->first()->id,
        ]);
        return back();
    }
    public function demote($id)
    {
        $superadmin = User::findOrFail($id);
        $superadmin->update([
            'role_id' => Role::select('id')->where('name', 'admin')->first()->id,
        ]);
        return back();
    }
    public function delete(User $user, Request $request)
    {
        try {
            $user->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = "row can't br deleted";
        }
        $request->session()->flash('msg', $msg);
        return  back();
    }
}
