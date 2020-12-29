<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Models\VartotojoTipas;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::if('role', function (...$roles) {
            if (auth()->check()) {
                $type = VartotojoTipas::findOrFail(auth()->user()->vartotojo_tipas);

                foreach ($roles as $role) {
                    if ($type->pavadinimas == $role)
                        return true;
                }
            }

            return false;
        });
    }
}
