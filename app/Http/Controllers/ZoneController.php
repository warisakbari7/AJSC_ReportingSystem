<?php

namespace App\Http\Controllers;

use App\Models\zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = zone::all('id','name');
        return view('zone.index',compact('zones'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:zones',
        ]);
        $zone = zone::create($request->toArray());
        return response()->json($zone);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, zone $zone)
    {
        $request->validate([
            'name' => 'required|unique:zones'
        ]);
        $zone->name = $request->name;
        $zone->save();
        return response()->json($request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(zone $zone)
    {
        $zone->delete();
        return response()->json($zone->toArray());
    }
}
