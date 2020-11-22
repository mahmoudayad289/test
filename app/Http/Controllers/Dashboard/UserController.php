<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function __construct()
{
    $this->middleware('permission:read_users')->only(['index']);
    $this->middleware('permission:create_users')->only(['create','store']);
    $this->middleware('permission:update_users')->only(['edit','update']);
    $this->middleware('permission:delete_users')->only(['destroy']);
}



    public function index(Request $request)
    {


        $roles = Role::WhereNotRole(['super_admin'])->get();
        $users = User::SearchByRoles($request->role)
            ->with('roles')
            ->WhenSearch($request->search)
            ->WhereNotRole(['super_admin'])
            ->latest()
            ->paginate(7);


        return view('dashboard.users.index', compact('users','roles'));
    }


    public function create(Request $request)
    {
        $roles = Role::WhereNotRole(['super_admin'])->get();
        return view('dashboard.users.create',compact('roles'));
    }


    public function store(UserFormRequest $request)
    {

        $request_data = $request->except(['image']);


        if ($request->avatar) {
         Image::make($request->avatar)->resize(300, null, function ($constraint) {
             $constraint->aspectRatio();
         })->save(public_path('uploads/image_user/' . $request->avatar->hashName()));
         $request_data['avatar'] = $request->avatar->hashName();
        }

        $user = User::create($request_data);
        $user->syncRoles(['user',$request->roles]);

        $request->session()->flash('success', __('site.add_success'));

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::WhereNotRole(['super_admin'])->get();
        return view('dashboard.users.edit', compact('roles','user'));
    }


    public function update(Request $request, User $user)
    {
        $request_data = $request->except(['image']);
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'roles' => 'array|min:1',
            'image' => 'nullable|image',
        ]);

        if ($request->avatar) {
            if ($user->avatar != 'avatar.jpg') {
                Storage::disk('public_uploads')->delete('/image_user/' . $user->avatar);
            }
            Image::make($request->avatar)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/image_user/' . $request->avatar->hashName()));
            $request_data['avatar'] = $request->avatar->hashName();
        }

        $user->update($request_data);

        $user->syncRoles(['user',$request->roles]);
        $request->session()->flash('success', __('site.update_success'));

        return redirect()->route('users.index');
    }


    public function destroy( User $user)
    {

        if ($user->avatar != 'avatar.jpg') {
            Storage::disk('public_uploads')->delete('/image_user/' . $user->avatar);
        }


        $user->delete();

    session()->flash('success', __('site.delete_success'));

        return redirect()->route('users.index');
    }
}
