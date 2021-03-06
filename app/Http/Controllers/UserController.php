<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $this->authorize('manage-users', User::class);

        return view('users.index', ['users' => $model->with('role')->get()]);
    }

    /**
     * Show the form for creating a new user
     *
     * @param  \App\Role  $model
     * @return \Illuminate\View\View
     */
    public function create(Role $model)
    {
        return view('users.create', ['roles' => $model->get(['id', 'name'])]);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge([
            'picture' => $request->photo ? $request->photo->store('profile', 'public') : null,
            'password' => Hash::make($request->get('password'))
        ])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @param  \App\Role  $model
     * @return \Illuminate\View\View
     */
    public function edit(User $user, Role $model)
    {
        return view('users.edit', ['user' => $user->load('role'), 'roles' => $model->get(['id', 'name'])]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge([
                'picture' => $request->photo ? $request->photo->store('profile', 'public') : $user->picture,
                'password' => Hash::make($request->get('password'))
            ])->except([$hasPassword ? '' : 'password'])
        );

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
    public function destroyAJAX(Request $request)
    {   
        // Setting is_active column from users table to false
        $user = new User;
        $id = $request->id;
        $del_user  = $user->removeAcc($id); 
    }

    public function getUser($id)
    {
        //Gets user for view profile modal
        $user = new User;
        $get_user = $user->getUserWithID($id);
        $return_user  = json_decode($get_user);
        $date = Carbon::parse($return_user[0]->join_date)->format('F d, Y');
        $email = $return_user[0]->email;
        $name = $return_user[0]->name;
        $role = $return_user[0]->role_name;
        $role_id = $return_user[0]->role_id;

        $data = array(
            'date' => $date,
            'email' => $email,
            'name' => $name,
            'role' => $role,
            'role_id' => $role_id
        );
        return json_encode($data);
    }
}
