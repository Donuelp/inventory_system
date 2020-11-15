<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Carbon\Carbon;

class UserManagementController extends Controller
{
    public function index()
    {
    	$user = new User;
    	$roles = Role::all();
    	$admins = $user->get_admins();
    	$members = $user->get_members();
    	return view('pages.user-management', [
    		'roles' => $roles, 
    		'admins' => $admins,
    		'members' => $members
    	]);
    }
}
