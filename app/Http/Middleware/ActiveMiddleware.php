<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vartotojas;

class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idk = Vartotojas::where('email', '=', $_POST['email'])
            ->leftJoin('statusas', 'vartotojai.statusas', '=', 'statusas.id')
            ->first();

        if (!is_null($idk) && $idk->pavadinimas == "Aktyvus")
            return $next($request);

        return back()->withErrors([
            'email' => 'Vartotojas neegzistuoja.',
        ]);
    }
}
