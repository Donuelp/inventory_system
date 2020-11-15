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

use App\Tag;
use App\Item;
use App\Branches;
use App\Category;
use App\Measurement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    /**
     * Display a listing of the items
     *
     * @param \App\Item  $itemModel
     * @param \App\Category $categoryModel
     * @param \App\Branch $branbranchModelch
     * @param \App\Measurement $measurementModel
     * @return \Illuminate\View\View
     */
    public function index(Item $itemModel, Category $categoryModel, Branches $branchModel, Measurement $measurementModel)
    {   
        return view('pages.masterfile.items', ['items' => $itemModel->get_items(), 'categories' => $categoryModel->get_categories(), 'branches' => $branchModel->getBranches(), 'measurements' => $measurementModel->get_measurements()]);
    }

    /**
     * Store a newly created item in storage
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Item  $items
     */
    public function store(Request $request, Item $items)
    {

        $data = array(
                'name' => $request->item_name,
                'description' => $request->item_desc,
                'category_id' => $request->category_id,
                'branch_id' => $request->branch_id,
                'measure_id' => $request->measure_id,
                'cost' => $request->item_cost,
                'price' => $request->item_price,
                'quantity' => $request->item_quantity
            );
        $items->add_items(json_encode($data));
    }

    /**
     * Show the form for editing the specified item
     *
     * @param  \App\Item  $item
     * @param  \App\Tag   $tagModel
     * @param  \App\Category $categoryModel
     * @return \Illuminate\View\View
     */
    public function edit(Item $items)
    {
        return view('items.edit', [
            'item' => $item->load('tags'),
            'tags' => $tagModel->get(['id', 'name']),
            'categories' => $categoryModel->get(['id', 'name'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Itemuest  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
}
