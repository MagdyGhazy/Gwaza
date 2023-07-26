<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\ProviderRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProviderRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = ProviderRequest::get();
        return view('Providers.ProviderRequests',compact('requests'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $find_request = ProviderRequest::find($request->id);
        $get_user = User::find($find_request->user_id);
        $get_user->update([
            'id_number' => $find_request->id_number,
            'id_photo_front' => $find_request->id_photo_front,
            'id_photo_back' => $find_request->id_photo_back,
            'criminal_fish' => $find_request->criminal_fish,
            'user_type' => UserRoleEnum::PROVIDER,
        ]);
        if ($get_user) {
            $find_request -> Delete();
            return redirect()->back();
        }
        return redirect()->back()->withErrors();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Grades = ProviderRequest::findOrFail($request->id);
        $Grades -> Delete();
        return redirect()->back();
    }
}
