<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveSubscription
{
    /**
     * بررسی وجود اشتراک فعال برای کاربر.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return redirect()
                ->route('login')
                ->with('error', 'برای دسترسی به این بخش ابتدا وارد حساب کاربری خود شوید.');
        }

        $hasActiveSubscription = $request->user()
            ->subscriptions()
            ->where('status', 'active')
            ->whereDate('starts_at', '<=', today())
            ->whereDate('ends_at', '>=', today())
            ->exists();

        if (!$hasActiveSubscription) {
            return redirect()
                ->route('subscription')
                ->with('error', 'برای دسترسی به این بخش باید اشتراک فعال داشته باشید.');
        }

        return $next($request);
    }
}