<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\Album\StoreAblumRequest;
use App\Http\Requests\Album\UpdateAblumRequest;
use App\Http\Requests\Album\SelectionAblumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = auth()->user()->albums;
        return view('albums.index', compact('albums'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAblumRequest $request)
    {
        auth()->user()->albums()->create(
            [
                "name"=>$request->name,
            ]
        );

        return to_route('albums.index')->with('success','Album is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAblumRequest $request, Album $album)
    {
        $album->update(
            [
                "name"=>$request->name,
            ]
        );

        return to_route('albums.show',$album)->with('success','Name of album is updated successfully.');
    }
    public function move(SelectionAblumRequest $request, Album $album)
    {
        $selection = Album::find($request->selection);

        foreach ($album->getMedia('album') as $media) {
            $selection->addMedia($media->getPath())->toMediaCollection('album');
        }
        $album->delete();
        return to_route('albums.index')->with('success','Pictures is moved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return to_route('albums.index',$album)->with('success','Album is deleted successfully.');
    }
}
