<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if ($user === null) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()
                ->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        if (
            $user instanceof MustVerifyEmail
            && $user->markEmailAsVerified()
        ) {
            event(new Verified($user)); // ✅ PHPStan sekarang AMAN
        }

        return redirect()
            ->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
