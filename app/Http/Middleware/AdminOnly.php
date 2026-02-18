<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        $adminEmail = 'admin@admin.com';

        if (!auth()->check() || auth()->user()->email !== $adminEmail) {
            return redirect('/')
                ->with('ok', 'Нет доступа к админ-панели.');
        }

        return $next($request);
    }
}
