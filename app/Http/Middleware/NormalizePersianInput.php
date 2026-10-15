<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NormalizePersianInput
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(
            $this->normalize($request->all())
        );

        return $next($request);
    }

    /**
     * Normalize all request input recursively.
     */
    private function normalize(mixed $value): mixed
    {
        if (is_array($value)) {
            return array_map(
                fn ($item) => $this->normalize($item),
                $value
            );
        }

        if (is_string($value)) {
            return toEnglishDigits($value);
        }

        return $value;
    }
}