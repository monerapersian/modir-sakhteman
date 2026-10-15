<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * نمایش صفحه ورود.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * انجام ورود کاربر.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt([
            'phone' => $validated['phone'],
            'password' => $validated['password'],
        ], $remember)) {
            throw ValidationException::withMessages([
                'phone' => 'شماره موبایل یا رمز عبور صحیح نیست.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('manager.dashboard'));
    }

    /**
     * خروج از حساب کاربری.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'با موفقیت از حساب کاربری خارج شدید.');
    }
}