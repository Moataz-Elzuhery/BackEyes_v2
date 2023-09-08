<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
     }
    public function index()
    {
        $members = Member::where('user_id',auth()->id())->get();
        return view('members.index',['members'=> $members]);
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $validatedData['member_image']->store('public/uploads/members');
        $imageUrl = Storage::url($imagePath);

        $member = new Member;
        $member->member_image = $imageUrl;
        $member->user_id = auth()->id();
        $member->save();

        return redirect('/members')->with('success', 'Feature added successfully!');
    }



    public function show($id)
    {
      
        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('members.show', ['member' => $member]);
    }

    public function edit($id)
    {
     
        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('members.edit', ['member' => $member]);
    }

    public function update(Request $request, $id){

        
        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $member->save();

        return redirect('/members')->with('success', 'Feature updated successfully!');
    }

    public function delete($id)
    {

        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($member->member_image);

     
        $member->delete();

        return redirect('/members')->with('success', 'Feature deleted successfully!');
    }
}