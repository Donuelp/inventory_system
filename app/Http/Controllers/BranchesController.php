<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branches;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->branches = new Branches;
    // }
    public function index(Branches $branches)
    {   
        return view('pages.masterfile.branches', ['branches' => $branches->getBranches()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Branches
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Branches $branches)
    {   

        $data = array(
                'name' => $request->branch_name,
                'description' => $request->branch_desc
            );
        $branches->addBranches(json_encode($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param App\Branches
     * @return \Illuminate\Http\Response
     */
    public function edit(Branches $branches, $id)
    {
        return $branches->show_branch_details($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param App\Branch
     * @return \Illuminate\Http\Response
     */
    public function updateAJAX(Request $request, Branches $branches)
    {
        $data = array(
                'id' => $request->id,
                'name' => $request->branch_name,
                'description' => $request->branch_desc
            );
        $branches->save_changes(json_encode($data));
    }
    public function move_inventory($id)
    {

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyAJAX(Request $request)
    {
        return $request->all();
    }
}
