<?php

namespace App\Http\Controllers\Modul\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Services\Modul\Auth\ProfileService;
use App\Http\Requests\Modul\Auth\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Profile service instance
     *
     * @var ProfileService
     */
    protected ProfileService $profileService;
    
    /**
     * Create a new controller instance.
     *
     * @param ProfileService $profileService
     * @return void
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('modul.auth.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        
        $this->profileService->updateProfile(
            $user, 
            $validated, 
            $request->hasFile('avatar') ? $request->file('avatar') : null
        );
        
        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $this->profileService->updatePassword(Auth::user(), $validated['password']);
        
        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }
    
    /**
     * Delete the user's account.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $user = Auth::user();
        
        Auth::logout();
        $this->profileService->deleteAccount($user);
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
