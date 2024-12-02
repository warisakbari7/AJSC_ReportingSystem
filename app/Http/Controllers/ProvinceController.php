<?php

namespace App\Http\Controllers;

use App\Models\province;
use App\Models\zone;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = province::with('zone')->get();
        $zones = zone::all('name','id');
        return view('province.index',compact('provinces','zones'));
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
            'name' => 'required|unique:provinces',
        ]);
        $province = new province();
        $province->name = trim($request->name);
        $province->zone_id = $request->zone;
        $province->save();
        $row = '<tr id="'.$province->id.'" data-province="'.$province->name.'">
        <td></td>
        <td>'.$province->name.'</td>
        <td>'.$province->zone->name.'</td>
        <td><a href="javascript:void(0)"><i class="fa fa-trash text-sm text-gray" id="delete_btn"></i></a></td>
        <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray" id="edit_btn"></i></a></td>
        </tr>';
        return response()->json($row);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, province $province)
    {
        if($request->zone == $province->zone_id)
        {
            $request->validate([
                'name' => 'required|unique:provinces',
            ]);
        }

        $province->name = trim($request->name);
        $province->zone_id = trim($request->zone);
        $province->save();

        $row = '<tr id="'.$province->id.'" data-province="'.$province->name.'">
        <td></td>
        <td>'.$province->name.'</td>
        <td>'.$province->zone->name.'</td>
        <td><a href="javascript:void(0)"><i class="fa fa-trash text-sm text-gray" id="delete_btn"></i></a></td>
        <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray" id="edit_btn"></i></a></td>
        </tr>';
        $id = $province->id;
        return response()->json([$row,$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(province $province)
    {
        $province->delete();
        return response()->json($province->toArray());
    }
}
