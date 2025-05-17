<?php

namespace App\Http\Controllers\Modul_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Modul_Auth\Profile_Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class Profile_Controller extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        return view('modul_auth.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Profile_Request $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        
        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && !str_contains($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }
        
        $user->update($validated);
        
        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }
    
    /**
     * Delete the user's account.
     */
    public function delete(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $user = Auth::user();
        
        // Delete avatar if exists and not a URL
        if ($user->avatar && !str_contains($user->avatar, 'http')) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        Auth::logout();
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
