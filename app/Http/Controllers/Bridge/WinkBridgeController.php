<?php

namespace App\Http\Controllers\Bridge;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Wink\WinkAuthor;

class WinkBridgeController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if ($this->bridge()) {

            $this->loginAppUserAsWinkAuthor(auth('web')->user());
            return redirect()->intended('/' . config('wink.path'));
        }
        return view('wink::login');
    }

    /**
     * Attempt to log in.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if ($this->bridge()) {

            $this->loginAppUserAsWinkAuthor(auth('web')->user());
            return redirect()->intended('/' . config('wink.path'));
        }

        validator(request()->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($this->guard()->attempt(
            request()->only('email', 'password'),
            request()->filled('remember')
        )) {
            return redirect('/' . config('wink.path'));
        }

        throw ValidationException::withMessages([
            'email' => ['Invalid email or password!'],
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('wink.auth.login')->with('loggedOut', true);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('wink');
    }

    protected function bridge(): bool
    {
        if (auth('web')->user() && $this->checkIfAppUserIsWinkAuthor(auth('web')->user())) {
            return true;
        }

        return false;
    }

    protected function checkIfAppUserIsWinkAuthor(User $user): bool
    {
        return $user->isWinkAuthor();
    }

    protected function loginAppUserAsWinkAuthor(User $user)
    {
        return auth('wink')->login(
            WinkAuthor::where('email', $user->email)->first()
        );
    }
}
