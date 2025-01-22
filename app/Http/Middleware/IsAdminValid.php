<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\IsNotAdminException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminValid
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws IsNotAdminException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::user()->admin) {
            throw new IsNotAdminException();
        }
        return $next($request);
    }
}
