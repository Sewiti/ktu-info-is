<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VartotojoTipas;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (auth()->check()) {
            $type = VartotojoTipas::findOrFail(auth()->user()->vartotojo_tipas);

            foreach ($roles as $role) {
                if ($type->pavadinimas == $role)
                    return $next($request);
            }
        }

        return abort(404);
    }
}
