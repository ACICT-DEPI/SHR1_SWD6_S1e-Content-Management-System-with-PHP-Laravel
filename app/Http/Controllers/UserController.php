<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function index()
    {
        // Get all users
        $users = User::all();
        return view('backend.users', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully!');
    }
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $user = User::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete old image if necessary
            if ($user->img) {
                Storage::disk('public')->delete($user->img);
            }

            // Store the new image
            $user->img = $request->file('img')->store('images', 'public');
        }

        $user->save();

        return redirect()->back()->with('status', 'User image updated successfully!');
    }
}
