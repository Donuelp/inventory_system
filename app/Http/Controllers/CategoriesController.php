<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;



class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param App\Category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $categories)
    {
        return view('pages.masterfile.categories', ['categories' => $categories->get_categories()]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param App\Category
     * @return \Illuminate\Http\Response
     */
    public function store(Category $categories, Request $request)
    {
        $data = array(
                'name' => $request->category_name,
                'description' => $request->category_desc
            );
        
        $categories->add_category(json_encode($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param App\Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories, $id)
    {
        return $categories->show_category_details($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param App\Category
     * @return \Illuminate\Http\Response
     */
    public function updateAJAX(Request $request, Category $categories)
    {
        $data = array(
                'id' => $request->id,
                'name' => $request->category_name,
                'description' => $request->category_desc
            );
        $categories->save_changes(json_encode($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
