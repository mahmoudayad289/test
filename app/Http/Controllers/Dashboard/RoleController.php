<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleFormRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create','store']);
        $this->middleware('permission:update_roles')->only(['edit','update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);
    }


    public function index(Request $request)
    {

        $roles = Role::whenSearch($request->search)
            ->with('permissions')
            ->withCount('users')
            ->whereNotRole(['super_admin'])
            ->paginate(10);

        return view('dashboard.roles.index', compact('roles'));
    }


    public function create(Request $request)
    {
        $permissions = Permission::select('id','name')->get();
        return view('dashboard.roles.create',compact('permissions'));
    }


    public function store(RoleFormRequest $request)
    {

         $roles = Role::create(['name' => $request->input('name')]);
        $roles->syncPermissions($request->input('permissions'));

        session()->flash('success', __('site.add_success'));

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::select('id','name')->get();
        return view('dashboard.roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:400|unique:roles,name,' . $role->id,
        ]);
        $role->update(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));
        $request->session()->flash('success', __('site.update_success'));

        return redirect()->route('roles.index');
    }


    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        $request->session()->flash('success', __('site.delete_success'));

        return redirect()->route('roles.index');
    }
}
