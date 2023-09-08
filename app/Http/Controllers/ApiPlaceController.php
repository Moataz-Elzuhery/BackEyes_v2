<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiPlaceController extends Controller
{
    public function index()
    {
        $places = Place::where('user_id', auth()->id())->get();

        return response()->json($places);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'place_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
     
        ]);

        $imagePath = $validatedData['place_image']->store('public/uploads/places');
        $imageUrl = Storage::url($imagePath);

        $place = new Place;
        $place->place_image = $imageUrl;
        $place->user_id = auth()->id();
        $place->save();

        return response()->json($place, 201);
    }

    public function show($id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return response()->json($place);
    }

    public function update(Request $request, $id)
    {

        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $place->save();

        return response()->json($place);
    }

    public function delete($id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($place->place_image);

        $place->delete();

        return response()->json(null, 204);
    }
}