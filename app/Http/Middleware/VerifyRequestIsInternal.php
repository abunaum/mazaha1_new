<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyRequestIsInternal
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $referer = $request->header('Referer');
        $allowedReferer = config('app.url');

        if (parse_url($referer, PHP_URL_HOST) !== parse_url($allowedReferer, PHP_URL_HOST)) {
            return response()->json([
                'error' => '403 Forbidden',
                'code' => '403',
                'message' => 'Anda tidak diizinkan mengakses API ini.',
            ], 403);
        }

        return $next($request);
    }
}
