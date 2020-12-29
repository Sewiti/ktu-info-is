<?php

namespace App\Http\Controllers;

use App\Models\Prekes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index() {
        $currentCart = Session::get('cart');
        $cart = array();
        $pos = 0;
        if(Session::has('cart')) {
            foreach ($currentCart[0]->items as $item) {
                $item = Prekes::where('id', $item)->first();
                $item->quantity = $currentCart[0]->quantity[$pos];
                array_push($cart, $item);
                $pos++;
            }
        }
        return view('cart.cart', ['cart' => $cart]);
    }

    public function store($id, Request $request) {
        if($request->input('quantity') < 1) {
            return Redirect::back()->with('error', 'Kiekis turi būti didesnis nei 0');
        }
        if(Prekes::where([['id', $id],['statusas', 1]])->first()) {
            $currentCart = Session::get('cart');
            if(!$currentCart) {
                $currentCart = new \stdClass();
                $currentCart->items = array();
                $currentCart->quantity = array();
            } else {
                $currentCart = $currentCart[0];
            }
            array_push($currentCart->items, $id);
            array_push($currentCart->quantity, $request->input('quantity'));
            Session::forget('cart');
            Session::push('cart', $currentCart);
            return Redirect::back()->with('success', 'Prekė sėkmingai pridėta į prekių krepšelį');
        } else {
            return Redirect::back()->with('error', 'Tokia prekė neegzistuoja');
        }
    }

    public function delete($position) {
        $cart = Session::get('cart');
        if($cart) {
            if(count($cart[0]->items) >= $position) {
                unset($cart[0]->items[$position]);
                unset($cart[0]->quantity[$position]);
                $cart[0]->items = array_values($cart[0]->items);
                $cart[0]->quantity = array_values($cart[0]->quantity);
                Session::forget('cart');
                if(count($cart[0]->items) > 0) {
                    Session::push('cart', $cart[0]);
                }
            }
        }
        return Redirect::back();
    }
}
