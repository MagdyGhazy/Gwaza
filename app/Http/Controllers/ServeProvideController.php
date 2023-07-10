<?php

namespace App\Http\Controllers;

use App\Models\ServeProvide;
use Illuminate\Http\Request;

class ServeProvideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servs=ServeProvide::all();
        return view('Service.Services',compact('servs'));
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
       ServeProvide::create([
//            'photo'=>$image,
            'name'=>$request->name,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServeProvide  $serveProvide
     * @return \Illuminate\Http\Response
     */
    public function show(ServeProvide $serveProvide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServeProvide  $serveProvide
     * @return \Illuminate\Http\Response
     */
    public function edit(ServeProvide $serveProvide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServeProvide  $serveProvide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServeProvide $serveProvide)
    {
        ServeProvide::update([
//            'photo'=>$image,
            'name'=>$request->name,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServeProvide  $serveProvide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServeProvide::find($id)->delete();
        return redirect()->back();
    }
}
