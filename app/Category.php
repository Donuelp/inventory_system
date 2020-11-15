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

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Category extends Model
{

    public function get_categories()
    {
        return DB::table('categories')
        ->get();
    }

    public function add_category($data)
    {
        $insert_data = json_decode($data);
        $name = $insert_data->name;
        $desc = $insert_data->description;
        DB::table('categories')->insert(
            [
                'name' => $name,
                'description' => $desc,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }

    public function show_category_details($id)
    {
        return DB::table('categories')
        ->where('id', $id)
        ->get();
    }

     public function save_changes($data)
    {
        $insert_data = json_decode($data);
        DB::table('categories')
        ->where('id', $insert_data->id)
        ->update(
            [
                'name' => $insert_data->name,
                'description' => $insert_data->description,
                'updated_at' => Carbon::now()
            ]);
    }
}
