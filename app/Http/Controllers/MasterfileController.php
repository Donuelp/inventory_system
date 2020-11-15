<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterfileController extends Controller
{
    public function branches()
    {
    	return view('pages.masterfile.branches');
    }
}
