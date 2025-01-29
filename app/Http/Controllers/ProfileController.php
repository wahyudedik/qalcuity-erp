<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // First validate and get all input data
        $data = $request->validated();

        // Check if image file exists in the request
        if ($request->file('gambar')) {
            // Get the image file from request
            $file = $request->file('gambar');

            // Create a unique filename using timestamp and original name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to storage/app/public/images directory
            $file->move(public_path('storage/images'), $filename);

            // Set the path for database storage
            $data['gambar'] = 'images/' . $filename;

            // Delete old image if exists
            if ($request->user()->gambar) {
                $oldPath = public_path('storage/' . $request->user()->gambar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
