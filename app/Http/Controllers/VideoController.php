<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Auth;
use App\Media;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('upload');
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
    public function store(Request $rq)
    {
    
        $file = $rq->file('file');
        $fileName = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();

        $newFile = uniqid().'_'.rand(999999, 99999999).'.'.$fileExt;

        $path = '/public/uploads/';

        $upload_path = Storage::putFileAs( $path, $file,  $newFile );

        $data = new Media;
        $data->user_id = Auth::user()->id;
        $data->file_name = $newFile; 	 
        $data->file_url = $upload_path ;
        $data->file_type = "image";
        $data->save();
        
        return response()->json(['success' => 'Succesfully Uploaded.', 'file_name' => $newFile ]);  

    }

    public function store_all(Request $rq)
    {
         dd($rq->all());
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
