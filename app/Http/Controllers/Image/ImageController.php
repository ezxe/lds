<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Response;
use validate;

class ImageController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Image::all();
        return $this->showAll($image);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['album_id'=> 'required|exists:albums,id', 'url_image' => 'required']);
        $image = Image::create(['album_id' => $request['album_id'], 'url_image' => $request['url_image']]);
        return $this->showOne($image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    //listar todo
    public function listImage()
    {
        $data = Image::all();
        return response()->json($data);
        return $this->showAll($image);
    }

    public function show($id)
    {
        $image= Image::find($id);
        return response()->json($image);
        return $this->showOne($image);
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
        $request->validate(['album_id'=> 'required|exists:albums,id', 'url_image' => 'required']);
        $image = Image::findOrFail($id);
        $image->fill(['album_id' => $request['album_id'], 'url_image' => $request['url_image']]);
        $image->save();
        return $this->showOne($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return $this->showOne($image);
    }
}
