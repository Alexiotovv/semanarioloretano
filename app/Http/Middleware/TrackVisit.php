<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            Visit::create([
                'ip_address' => $request->ip(),
                'url' => $request->path(),
                'referrer' => $request->headers->get('referer'),
                'user_agent' => $request->userAgent(),
                'device_type' => $this->deviceType($request->userAgent()),
                'session_id' => $request->session()->getId(),
                'visited_at' => now(),
            ]);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        return $request->isMethod('GET')
            && ! $request->user()
            && ! $request->ajax()
            && ! $request->is('login', 'up')
            && $response->isSuccessful();
    }

    private function deviceType(?string $userAgent): string
    {
        if (preg_match('/tablet|ipad/i', $userAgent ?? '')) {
            return 'Tableta';
        }

        if (preg_match('/mobile|android|iphone|ipod/i', $userAgent ?? '')) {
            return 'Móvil';
        }

        return 'Escritorio';
    }
}