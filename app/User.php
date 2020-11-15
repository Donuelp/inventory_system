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
namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'picture', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role of the user
     *
     * @return \App\Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the path to the profile picture
     *
     * @return string
     */
    public function profilePicture()
    {
        if ($this->picture) {
            return "/storage/{$this->picture}";
        }

        return 'http://i.pravatar.cc/200';
    }

    /**
     * Check if the user has admin role
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    /**
     * Check if the user has creator role
     *
     * @return boolean
     */
    public function isCreator()
    {
        return $this->role_id == 2;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isMember()
    {
        return $this->role_id == 3;
    }

    public function get_admins()
    {
        return DB::table('users')
        ->where([
            'role_id' => 1
        ])
        ->get();
    }

    public function get_members()
    {
        return DB::table('users')
        ->where([
            'role_id' => 3
        ])
        ->get();
    }

    public function removeAcc($id)
    {
        DB::TABLE('users')->where('id', $id)
        ->update([
            'is_active' => false
        ]);
         return 'success';
    }

    public function getUserWithID($id)
    {
        $user = DB::TABLE('users')
        ->where([
            'users.id' => $id,
            'users.is_active' => true
        ])
        ->select('users.name as name', 'users.email as email', 'users.created_at as join_date', 'roles.name as role_name', 'roles.id as role_id')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->take(1)
        ->get();

        return $user;
    }
}
