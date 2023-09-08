<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiMemberController extends Controller
{
    public function index()
    {
        $members = Member::where('user_id', auth()->id())->get();

        return response()->json($members);
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

        return response()->json($member, 201);
    }

    public function show($id)
    {
        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return response()->json($member);
    }

    public function update(Request $request, $id)
    {

        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $member->save();

        return response()->json($member);
    }

    public function delete($id)
    {
        $member = Member::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the image file from storage
        Storage::delete($member->member_image);

        $member->delete();

        return response()->json(null, 204);
    }
}