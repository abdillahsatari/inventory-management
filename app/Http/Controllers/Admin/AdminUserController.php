<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FormType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = User::whereNot('status', 'removed')->get();
        $pageTemplate = collect([
            "hasmodal" => false,
        ]);

        return view('admin.adminUsers.index', compact('users', 'pageTemplate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::all();
        $pageTemplate = collect([
            "hasmodal" => false,
        ]);

        return view('admin.adminUsers.create', compact('roles' ,'pageTemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->user_name;
        $user->username = $request->user_username;
        $user->email = $request->user_email;
        $user->password = bcrypt('1234');
        $user->password_pin = bcrypt('1234');
        $user->status = $request->user_status;
        $user->role_id = $request->user_role_id;

        $user->save();

        return redirect()->route('admin.user.index')->with("Pengguna Berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        $pageTemplate = collect([
            "hasmodal" => false,
        ]);

        return view('admin.adminUsers.edit', compact('user', 'roles' ,'pageTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->user_name;
        $user->username = $request->user_username;
        $user->email = $request->user_email;
        $user->status = $request->user_status;
        $user->role_id = $request->user_role_id;
        $user->update();

        return redirect()->route('admin.user.edit', ["user" => $user->id ])->with("Pengguna Berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->status = 'removed';
        $user->update();

        return redirect()->route('admin.user.index')->with('success','Pengguna Berhasil dihapus');
    }
}
