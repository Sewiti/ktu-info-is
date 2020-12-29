<?php

namespace App\Http\Controllers;

use App\Models\Uzsakymas;
use App\Models\UzsakymoPreke;
use App\Models\Prekes;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        if (Auth::user()->vartotojo_tipas == 3)
            $orders = Uzsakymas::all();
        else
            $orders = Uzsakymas::where('vartotojo_id', Auth::id())->get();

        return view('orders.list', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Uzsakymas::findOrFail($id);

        $items = UzsakymoPreke::where('uzsakymo_id', $id)
            ->leftJoin('prekes', 'prekes.id', 'uzsakymo_preke.prekes_id')
            ->get();

        // dd($items);

        // $items = $order->uzsakymoPreke;
        // $prekesPavadinimas = Prekes::where($items, '')->get();

        // dd($items);

        return view('orders.view', ['order' => $order, 'items' => $items]);
    }
}
