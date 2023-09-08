<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use Illuminate\Support\Facades\Storage;

class AlertController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
     }
    public function index()
    {
        $alerts = Alert::where('user_id',auth()->id())->get();
        return view('alerts.index',['alerts'=> $alerts]);
    }

    public function create()
    {
        return view('alerts.create');
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

        return redirect('/alerts')->with('success', 'Feature added successfully!');
    }



    public function show($id)
    {
      
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('alerts.show', ['alert' => $alert]);
    }

    public function edit($id)
    {
     
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('alerts.edit', ['alert' => $alert]);
    }

    public function update(Request $request, $id){

        
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $alert->save();

        return redirect('/alerts')->with('success', 'Feature updated successfully!');
    }

    public function delete($id)
    {

        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($alert->alert_image);

     
        $alert->delete();

        return redirect('/alerts')->with('success', 'Feature deleted successfully!');
    }
}