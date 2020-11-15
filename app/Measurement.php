<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Measurement extends Model
{
    public function get_measurements()
    {
    	return DB::table('measurements')
        ->get();
    }

    public function add_measurement($data)
    {
    	$insert_data = json_decode($data);
    	DB::table('measurements')->insert(
    		[
    			'name' => $insert_data->name,
    			'description' => $insert_data->description,
    			'created_at' => Carbon::now(),
    			'updated_at' => Carbon::now()
    		]
    	);
    }

    public function show_measurement_details($id)
    {
    	return DB::table('measurements')
    	->where('id', $id)
    	->get();
    }

    public function save_changes($data)
    {
    	$insert_data = json_decode($data);
        DB::table('measurements')
        ->where('id', $insert_data->id)
        ->update(
        [
            'name' => $insert_data->name,
            'description' => $insert_data->description,
            'updated_at' => Carbon::now()
        ]);

    }
}
