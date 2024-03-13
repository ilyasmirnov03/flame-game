<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserCanEditOGData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = [
            UserRole::ADMIN->value,
            UserRole::REDACTOR->value,
        ];

        if (!in_array($request->user()->role, $allowedRoles)) {
            abort(403, 'Role incompatible');
        }

        return $next($request);
    }
}
