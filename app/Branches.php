<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Branches extends Model
{
    public function addBranches($data)
    {
    	$insert_data = json_decode($data);
    	$name = $insert_data->name;
    	$desc = $insert_data->description;
    	DB::table('branches')->insert(
    		[
    			'branch_name' => $name,
    			'branch_desc' => $desc,
    			'created_at' => Carbon::now(),
    			'updated_at' => Carbon::now()
    		]
    	);
    }
    public function getBranches()
    {
    	$branches = DB::table('branches')->get();
    	return $branches;
    }

    public function show_branch_details($id)
    {
    	$branch_details = DB::table('branches')
    	->where('id', $id)
    	->get();

    	return $branch_details;
    }

    public function save_changes($data)
    {
        $insert_data = json_decode($data);
        DB::table('measurements')
        ->where('id', $insert_data->id)
        ->update(
        [
            'branch_name' => $insert_data->name,
            'branch_desc' => $insert_data->description,
            'updated_at' => Carbon::now()
        ]);
    }

}
