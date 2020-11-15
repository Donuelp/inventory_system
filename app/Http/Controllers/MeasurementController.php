<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measurement;
use Carbon\Carbon;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Measurement
     * @return \Illuminate\Http\Response
     */
    public function index(Measurement $measurementModel)
    {

        return view('pages.masterfile.unit_measurement', ['measurements' => $measurementModel->get_measurements()]);
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
     * @param \App\Measurement @measurementModel
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Measurement $measurementModel)
    {
        $data = array(
                'name' => $request->measurement_name,
                'description' => $request->measurement_desc
            );
        $measurementModel->add_measurement(json_encode($data));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Measurement $measurements)
    {
        return $measurements->show_measurement_details($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Mesaurement @measurementModel
     * @return \Illuminate\Http\Response
     */ 

    public function updateAJAX(Request $request, Measurement $measurementModel)
    {
        $data = array(
                'id' => $request->id,
                'name' => $request->measurement_name,
                'description' => $request->measurement_desc,
                ''
            );
        $measurementModel->save_changes(json_encode($data));
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
