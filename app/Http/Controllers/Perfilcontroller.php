<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Perfilcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function uploadperfil(Request $request)
    {
        $data = $request->all();
        $id = Auth::id();

       //$ubicacionfila=$request->file('avatar')->store('public');

        if($request->hasfile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(160, 160)->save( public_path('/uploads/avatars/' . $filename) );
        }

        $dirimagen="uploads/avatars/".$filename;


        $sql="UPDATE users set  avatar='$dirimagen' WHERE id=$id";

        $procesocas=DB::update($sql);
        return $dirimagen;

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
    public function update(Request $request, $id)
    {
        //
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
