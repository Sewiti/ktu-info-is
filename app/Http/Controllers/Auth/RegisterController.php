<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pakvietimas;
use App\Providers\RouteServiceProvider;
use App\Models\Vartotojas;
use App\Models\VartotojoTipas;
use App\Models\Statusas;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'available']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'vardas' => 'required|min:2|max:32',
            'pavarde' => 'required|min:2|max:32',
            'email' => 'required|email|min:2|max:32',
            'password' => 'required|min:8|max:69|confirmed',
            'adresas' => 'nullable|min:3|max:123',
            'miestas' => 'nullable|min:3|max:69',
            'salis' => 'nullable|min:3|max:69',
            'pasto_kodas' => 'nullable|min:4|max:11',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Middleware takes care of unique email

        $user = Vartotojas::select('id')
            ->where('email', '=', $data['email'])
            ->first();

        if (is_null($user))
            $user = new Vartotojas();

        $user->vardas = $data['vardas'];
        $user->pavarde = $data['pavarde'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->adresas = $data['adresas'];
        $user->miestas = $data['miestas'];
        $user->salis = $data['salis'];
        $user->pasto_kodas = $data['pasto_kodas'];
        $user->vartotojo_tipas = VartotojoTipas::where('pavadinimas', 'Klientas')->first()->id;
        $user->statusas = Statusas::where('pavadinimas', 'Aktyvus')->first()->id;

        if (Session::has('ref')) {
            $ref = Session::get('ref')[0];

            $inv = Pakvietimas::where('nuoroda', $ref)
                ->first();

            if (!is_null($inv)) {
                $refUser = Vartotojas::where('pakvietimas', $inv->id)
                    ->first();

                $invCount = Vartotojas::select(DB::raw("COUNT(pakvietimas) pakvietimai"))
                    ->where('pakvietimas', $inv->id)
                    ->first()
                    ->pakvietimai;

                $inv->pakviesta_zmoniu = $invCount;
                $discount = $invCount * 0.003;
                if ($discount > 0.05)
                    $discount = 0.05;
                $inv->nuolaida = $discount;
                $inv->save();

                $user->pakviestas = $refUser->id;
            }
        }

        $user->save();

        return $user;
    }
}
