<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    // Route name prefixes to skip (admin pages, API, auth)
    private array $skipPrefixes = ['admin', 'login', 'logout', 'portal'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldLog($request, $response)) {
            try {
                $routeName = $request->route()?->getName() ?? '';
                VisitorLog::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                    'browser'    => $this->parseBrowser($request->userAgent()),
                    'os'         => $this->parseOs($request->userAgent()),
                    'device'     => $this->parseDevice($request->userAgent()),
                    'page_url'   => '/' . $request->path(),
                    'route_name' => $routeName,
                    'referer'    => substr($request->headers->get('referer', '') ?? '', 0, 500),
                    'session_id' => $request->session()->getId(),
                    'visited_at' => now(),
                ]);
            } catch (\Throwable) {
                // Never break the response on logging failure
            }
        }

        return $response;
    }

    private function shouldLog(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET') || $request->ajax()) {
            return false;
        }

        if ($response->getStatusCode() >= 400) {
            return false;
        }

        $routeName = $request->route()?->getName() ?? '';
        foreach ($this->skipPrefixes as $prefix) {
            if (str_starts_with($routeName, $prefix)) {
                return false;
            }
        }

        // Skip admin URL paths as fallback
        if (str_starts_with($request->path(), 'admin') || str_starts_with($request->path(), 'api/')) {
            return false;
        }

        return true;
    }

    private function parseBrowser(?string $ua): string
    {
        if (!$ua) return 'Unknown';
        if (str_contains($ua, 'Edg/') || str_contains($ua, 'Edge'))  return 'Edge';
        if (str_contains($ua, 'OPR/') || str_contains($ua, 'Opera')) return 'Opera';
        if (str_contains($ua, 'Chrome'))  return 'Chrome';
        if (str_contains($ua, 'Firefox')) return 'Firefox';
        if (str_contains($ua, 'Safari'))  return 'Safari';
        return 'Other';
    }

    private function parseOs(?string $ua): string
    {
        if (!$ua) return 'Unknown';
        if (str_contains($ua, 'Windows'))                                          return 'Windows';
        if (str_contains($ua, 'Android'))                                          return 'Android';
        if (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad'))             return 'iOS';
        if (str_contains($ua, 'Macintosh') || str_contains($ua, 'Mac OS X'))      return 'macOS';
        if (str_contains($ua, 'Linux'))                                            return 'Linux';
        return 'Other';
    }

    private function parseDevice(?string $ua): string
    {
        if (!$ua) return 'Desktop';
        if (str_contains($ua, 'iPad') || str_contains($ua, 'Tablet')) return 'Tablet';
        if (str_contains($ua, 'Mobile') || str_contains($ua, 'iPhone') || str_contains($ua, 'Android')) return 'Mobile';
        return 'Desktop';
    }
}
