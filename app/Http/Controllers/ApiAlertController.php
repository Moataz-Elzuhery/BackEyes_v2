<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::where('user_id', auth()->id())->get();

        return response()->json($alerts);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'alert_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
     
        ]);

        $imagePath = $validatedData['alert_image']->store('public/uploads/alerts');
        $imageUrl = Storage::url($imagePath);

        $alert = new Alert;
        $alert->alert_image = $imageUrl;
        $alert->user_id = auth()->id();
        $alert->save();

        return response()->json($alert, 201);
    }

    public function show($id)
    {
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return response()->json($alert);
    }

    public function update(Request $request, $id)
    {

        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $alert->save();

        return response()->json($alert);
    }

    public function delete($id)
    {
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($alert->alert_image);

        $alert->delete();

        return response()->json(null, 204);
    }
}