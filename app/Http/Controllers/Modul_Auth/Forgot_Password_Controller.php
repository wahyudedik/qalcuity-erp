<?php

namespace App\Http\Controllers\Modul_Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modul_Auth\Forgot_Password_Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class Forgot_Password_Controller extends Controller
{
    /**
     * Show the forgot password form.
     */
    public function showForgotPasswordForm(): View
    {
        return view('modul_auth.forgot_password');
    }

    /**
     * Send a password reset link to the given user.
     */
    public function sendResetLinkEmail(Forgot_Password_Request $request): RedirectResponse
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
