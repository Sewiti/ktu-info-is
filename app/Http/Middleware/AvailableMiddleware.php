<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vartotojas;

class AvailableMiddleware
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
        $user = Vartotojas::select('vartotojai.*', 'statusas.pavadinimas')
            ->where('email', '=', $_POST['email'])
            ->leftJoin('statusas', 'vartotojai.statusas', '=', 'statusas.id')
            ->first();

        if (!is_null($user))
            if ($user->pavadinimas == "Aktyvus") {
                return back()->withErrors([
                    'email' => 'Toks paštas jau registruotas.',
                ]);
            }

        return $next($request);
    }
}
