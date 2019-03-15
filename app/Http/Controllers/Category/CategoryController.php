<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Response;
use validate;


class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return $this->showAll($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name|alpha|max:255']);
        //dd($request);
        $category = Category::create(['name' => $request['name']]);
       
    }

    //listar todo
    public function listCategory()
    {
        $category = Category::all();
        return $this->showOne($category);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
        return $this->showOne($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
         
    public function update(Request $request, $id)
    {
       
        $request->validate(['name' => 'required|unique:categories,name|alpha|max:255']);
        $category = Category::findOrFail($id);
        $category->fill(['name' => $request ['name']]);
        $category->save(); 
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryDelete = Category::findOrFail($id);
        $categoryDelete->delete();
        return $this->showOne($category);
    }

    public function categoryRestore($id)
    {
        Category::withTrashed()->where('id', $id)->restore();
        return $this->showOne($category);
    }
}
