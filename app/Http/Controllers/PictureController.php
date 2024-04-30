<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\Picture\StorePictureRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class PictureController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePictureRequest $request,Album $album)
    {

        if ($request->has('pictures')) {
            $album->addMultipleMediaFromRequest(['pictures']) ->each(function ($file) {

                $file->toMediaCollection('album');
            });
            return to_route('albums.show',$album)->with('success','Pictures is Added to that album successfully.');
        }else{

            return to_route('albums.show',$album)->with('error','No pictures were selected.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $picture = Media::findOrFail($id);
        $picture->delete();

        return back()->with('success', 'Picture deleted successfully');
    }
}
