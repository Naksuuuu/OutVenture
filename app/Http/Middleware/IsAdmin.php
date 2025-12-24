<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
  public function handle(Request $request, Closure $next): Response
  {
    if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')) {
      return $next($request);
    }

    abort(403, 'Unauthorized action.');
  }
}
