<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = News::query();
        if ($request->has('date')) {
            $news->whereDate('published_at',$request->date);
        }
        $page= $news->paginate(10);
        return response()->json(['news'=>$page->items(),'meta'=>[
            'total'=>$page->total(),
            'per_page'=>$page->perPage(),
            'current_page'=>$page->currentPage(),
            'last_page'=>$page->lastPage(),
        ]],200);
    }


    public function create($validdata)
    {

        $validated= $validdata->validate([
            'title'=>'required|max:255',
            'description'=>'required|string',
            'body'=>'required',
            'img'=>'required|mimes:jpg,jpeg,png,gif',
            'published_at'=>'required'
        ]);
        $news = News::create($validated);
        return response()->json(['news'=>$news],201);
    }




    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $new = News::findOrFail($id);
        return response()->json(['news'=>$new],200);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $new = News::findOrFail($id);
        $validated = $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|string',
            'body'=>'required',
            'img'=>'required|mimes:jpg,jpeg,png,gif',
            'published_at'=>'required'
        ]);
        $new->update($validated);

        return response()->json(['news'=>$new],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(['message'=>'News deleted successfully'],200);
    }
}
