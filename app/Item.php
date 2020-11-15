<?php
namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{	
	public function get_items()
	{
		return DB::table('items')
		->select('branches.branch_name as branch_name', 'categories.name as category_name', 'measurements.name as measurement_name', 'items.id as item_id', 'items.name as item_name', 'items.description as item_description', 'items.cost as item_cost', 'items.price as item_price', 'items.created_at as item_created_at')
		->leftjoin('categories', 'items.category_id', '=', 'categories.id')
		->leftjoin('branches', 'items.branch_id', '=', 'branches.id')
		->leftjoin('measurements', 'items.measure', '=', 'measurements.id')
        ->get();
	}
	public function add_items($data)
	{
		$insert_data = json_decode($data);
    	DB::table('items')->insert(
    		[
    			'name' => $insert_data->name,
    			'description' => $insert_data->description,
    			'category_id' => $insert_data->category_id,
    			'branch_id' => $insert_data->branch_id,
    			'measure' => $insert_data->measure_id,
    			'status' => false,
    			'cost' => $insert_data->cost,
    			'price' => $insert_data->price,
    			'quantity' => $insert_data->quantity,
    			'created_at' => Carbon::now(),
    			'updated_at' => Carbon::now()
    		]
    	);
	}
	public function show_item($id)
	{

	}
    public function save_changes($data)
    {

    }
}
