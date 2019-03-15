<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;
use Illuminate\Database\Migrations\Migration;
use validate;

class NewsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return $this->showAll($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:categories,id',
                            'title' => 'required|unique:news,title|max:255',
                            'subtitle' => 'required|unique:news,subtitle|max:255',
                            'date' => 'required|date',
                            'content' => 'required|nullable',
                            'outstanding' => 'required|boolean',
                            'url_pdf' => 'required',
                            'url_video' => 'required'
                           ]);
        //dd($request);
        $news= News::create(['category_id' => $request['category_id'],
                            'title' => $request['title'],
                            'subtitle' => $request['subtitle'],
                            'date' => $request['date'],
                            'content' => $request['content'],
                            'outstanding' => $request['outstanding'],
                            'url_pdf' => $request['url_pdf'],
                            'url_video' => $request['url_video']]);
        
        $news->images()->attach($request->get('array'));
        
        return $this->showOne($news);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news= News::find($id);
        return response()->json($news);
        return $this->showOne($news);
    }

    public function listNews()
    {
        $news = News::all();
        return response()->json($news);
        return $this->showAll($news);
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

        $request->validate(['category_id' => 'required|exists:categories,id',
                            'title' => 'required|unique:news,title|max:255',
                            'subtitle' => 'required|unique:news,subtitle|max:255',
                            'date' => 'required|date',
                            'content' => 'required|nullable',
                            'outstanding' => 'required|boolean',
                            'url_pdf' => 'required',
                            'url_video' => 'required'
                           ]);
        $news = News::findOrFail($id);
        $news->fill(['category_id' => $request['category_id'],
                            'title' => $request['title'],
                            'subtitle' => $request['subtitle'],
                            'date' => $request['date'],
                            'content' => $request['content'],
                            'outstanding' => $request['outstanding'],
                            'url_pdf' => $request['url_pdf'],
                            'url_video' => $request['url_video']]);
        $news->save();
        return $this->showOne($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return $this->showOne($news);
    }
}
