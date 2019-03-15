<?php

namespace App\Http\Controllers\Album;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;
use Illuminate\Database\Migrations\Migration;
use validate;

class AlbumController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $album = Album::all();
        return $this->showAll($album);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:albums,name|max:255']);
        $album = Album::create(['name' => $request['name']]);
        return $this->showOne($album);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return $this->showOne($album);
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
        
        $request->validate(['name' => 'required|unique:albums,name|max:255']);
        $album = Album::findOrFail($id);
        $album->fill(['name' => $request ['name']]);
        $album->save(); 
        return $this->showOne($album);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Album = Album::findOrFail($id);
        //para eliminar todas las imagenes aasoiadas al album
        //$Album->images()->delete(['album_id']);
        $Album->delete();
        //return $this->showAll($album->images);
        return $this->showOne($album);
        
    }
}
