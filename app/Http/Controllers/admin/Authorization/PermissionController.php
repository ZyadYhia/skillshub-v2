<?php

namespace App\Http\Controllers\admin\Authorization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return view('admin.authorization.permissions.index', compact('permissions'));
    }
}
