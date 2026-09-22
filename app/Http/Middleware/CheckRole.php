<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // چک کردن اینکه آیا نقش کاربر در لیست نقش‌های مجاز هست یا نه
        if(!($request->user()->isEditor())){
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }

        if(!($request->user()->isAdmin())){
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        return $next($request);
    }
}
