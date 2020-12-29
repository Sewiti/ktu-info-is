<?php

namespace App\Http\Controllers;

use App\Mail\StatusEmail;
use App\Models\Busena;
use App\Models\Uzsakymas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class StatusController extends Controller
{
    public function index() {
        return view('status.view');
    }

    public function show(Request $request) {
        $order = Uzsakymas::where('kodas', $request->input('kodas'))->first();
        if(!$order) {
            return Redirect::back()->with('error', 'Tokio užsakymo su nurodytu kodu nėra');
        }
        $status = $order->busena;

        return view('status.show', ['order' => $order, 'status' => $status]);
    }

    public function update($id, $status) {
        Busena::create([
            'uzsakymo_id' => $id,
            'atnaujinimo_laikas' => date("Y-m-d H:i:s"),
            'busena' => $status
        ]);

        $order = Uzsakymas::where('id', $id)->first();
        $user = $order->vartotojas;
        $status = $order->busena;

        Mail::to($user->email)->queue(new StatusEmail($order, $user, $status));

        return Redirect::back()->with('success', 'Būsena sėkmingai atnaujinta');
    }
}
