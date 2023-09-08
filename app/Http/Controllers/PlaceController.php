<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
     }
    public function index()
    {
        $places = Place::where('user_id',auth()->id())->get();
        return view('places.index',['places'=> $places]);
    }

    public function create()
    {
        return view('places.create');
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

        return redirect('/places')->with('success', 'Feature added successfully!');
    }



    public function show($id)
    {
      
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('places.show', ['place' => $place]);
    }

    public function edit($id)
    {
     
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('places.edit', ['place' => $place]);
    }

    public function update(Request $request, $id){

        
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $place->save();

        return redirect('/places')->with('success', 'Feature updated successfully!');
    }

    public function delete($id)
    {

        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($place->place_image);

     
        $place->delete();

        return redirect('/places')->with('success', 'Feature deleted successfully!');
    }
}