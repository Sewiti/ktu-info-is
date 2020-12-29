<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Vartotojas;
use App\Models\VartotojoTipas;
use App\Models\Statusas;
use App\Models\Pakvietimas;

class UsersController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        $users = Vartotojas::select('vartotojai.*')
            ->leftJoin('statusas', 'vartotojai.statusas', 'statusas.id')
            ->where('statusas.pavadinimas', 'Aktyvus')
            ->get();

        // $userId = auth()->user()->id;
        // // $problems = Problem::where('user_id', $userId)->where('deleted', false)->get();
        // $problems = $this->getProblem(null);

        // return view('problem.index', [
        //     'problems' => $problems,
        // ]);

        return view('users.index', [
            'users' => $users,
        ]);
    }


    // public function store()
    // {
    //     $data = request()->validate([
    //         'vardas' => 'required|min:2|max:32',
    //         'pavarde' => 'required|min:2|max:32',
    //         'email' => 'required|unique:vartotojai|email|min:2|max:32',
    //         'password' => 'required|min:8|max:69|confirmed',
    //         'adresas' => 'nullable|min:3|max:123',
    //         'miestas' => 'nullable|min:3|max:69',
    //         'salis' => 'nullable|min:3|max:69',
    //         'pasto_kodas' => 'nullable|regex:[A-Za-z0-9]{2,3}[0-9]{0,2}[- ]?[0-9]{2,5}',
    //     ]);

    //     $user = new Vartotojas();
    //     $user->vardas = $data['vardas'];
    //     $user->pavarde = $data['pavarde'];
    //     $user->email = $data['email'];
    //     $user->password = Hash::make($data['password']);

    //     if (!is_null($data['adresas']))     $user->adresas     = $data['adresas'];
    //     if (!is_null($data['miestas']))     $user->miestas     = $data['miestas'];
    //     if (!is_null($data['salis']))       $user->salis       = $data['salis'];
    //     if (!is_null($data['pasto_kodas'])) $user->pasto_kodas = $data['pasto_kodas'];

    //     $user->save();

    //     return redirect(route('home'));
    // }


    public function login()
    {
        return view('users.login');
    }


    public function create()
    {
        return view('users.create');
    }


    public function show($userId)
    {
        $user = Vartotojas::findOrFail($userId);

        if (Auth::user()->vartotojo_tipas == 3)
            $tipai = VartotojoTipas::get();

        return view('users.show', [
            'user' => $user,
            'roles' => $tipai ?? null,
        ]);
    }


    public function updateRole($userId)
    {
        $data = request()->validate([
            'vartotojo_tipas' => 'required|min:1|max:3',
        ]);

        $user = Vartotojas::findOrFail($userId);
        $user->vartotojo_tipas = $data['vartotojo_tipas'];
        $user->save();

        return redirect(route('users.show', ['userId' => $userId]));
    }


    public function update($userId)
    {
        if (Auth::id() != $userId)
            return abort(404);

        $data = request()->validate([
            'vardas' => 'required|min:2|max:32',
            'pavarde' => 'required|min:2|max:32',
            'email' => 'required|email|min:2|max:32',
            'password' => 'nullable|min:8|max:69|confirmed',
            'adresas' => 'nullable|min:3|max:123',
            'miestas' => 'nullable|min:3|max:69',
            'salis' => 'nullable|min:3|max:69',
            'pasto_kodas' => 'nullable|min:4|max:11',
        ]);

        $user = Vartotojas::select('vartotojai.*', 'statusas.pavadinimas')
            ->where('vartotojai.id', '!=', $userId)
            ->where('email', '=', $data['email'])
            ->leftJoin('statusas', 'vartotojai.statusas', '=', 'statusas.id')
            ->first();

        if (!is_null($user) && $user->pavadinimas == "Aktyvus") {
            return back()->withErrors([
                'email' => 'Toks paštas jau registruotas.',
            ]);
        }

        $user = Vartotojas::findOrFail($userId);

        $user->vardas = $data['vardas'];
        $user->pavarde = $data['pavarde'];
        $user->email = $data['email'];

        if (!is_null($data['password']))
            $user->password = Hash::make($data['password']);

        $user->adresas = $data['adresas'];
        $user->miestas = $data['miestas'];
        $user->salis = $data['salis'];
        $user->pasto_kodas = $data['pasto_kodas'];

        $user->save();

        return redirect(route('users.show', ['userId' => $userId]));
    }


    public function edit($userId)
    {
        if (Auth::id() != $userId)
            return abort(404);

        $user = Vartotojas::findOrFail($userId);

        return view('users.edit', [
            'user' => $user,
        ]);
    }


    public function destroy($userId)
    {
        if (Auth::id() != $userId)
            return abort(404);

        $user = Vartotojas::findOrFail($userId);
        $user->statusas = Statusas::where('pavadinimas', 'Ištrinta')->first()->id;
        $user->save();

        Auth::logout();

        return redirect(route('home'));
    }


    public function invite()
    {
        $user = Vartotojas::findOrFail(Auth::id());

        if (is_null($user->pakvietimas)) {
            $inv = new Pakvietimas();
            $inv->nuoroda = bin2hex(random_bytes(8));
            $inv->save();

            $user->pakvietimas = $inv->id;
            $user->save();
        } else {
            $inv = Pakvietimas::where('id', $user->pakvietimas)
                ->first();
        }

        return view('users.invite', [
            'inv' => $inv,
        ]);
    }
}
