<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Mail\StatusEmail;
use App\Models\Busena;
use App\Models\Pakvietimas;
use App\Models\Prekes;
use App\Models\Uzsakymas;
use App\Models\UzsakymoPreke;
use App\Models\Vartotojas;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use WebToPay;

require_once(public_path().'/WebToPay.php');

class PaymentController extends Controller
{
    public function index() {
        $user = null;
        if(Auth::check()) {
            $user = Auth::user();
        }
        return view('cart.payment', ['user' => $user]);
    }

    public function success() {
        Session::forget('cart');
        return view('cart.success');
    }

    public function denied() {
        return view('cart.denied');
    }

    public function store(Request $request) {
        $rules = ([
            'miestas' => 'required|max:64',
            'salis' => 'required|max:64',
            'adresas' => 'required|max:128',
            'pasto_kodas' => 'required|max:16'
        ]);
        $niceNames = array(
            'miestas' => 'Miestas',
            'salis' => 'Šalis',
            'adresas' => 'Adresas',
            'pasto_kodas' => 'Pašto kodas'
        );

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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

        Vartotojas::find(Auth::user()->id)->update([
            'miestas' => $request->input('miestas'),
            'salis' => $request->input('salis'),
            'adresas' => $request->input('adresas'),
            'pasto_kodas' => $request->input('pasto_kodas')
        ]);

        if($cart) {
            $totalPrice = 0;
            if(Pakvietimas::find(Auth::user()->pakvietimas)) {
                $discount = Pakvietimas::find(Auth::user()->pakvietimas)->nuolaida;
            } else {
                $discount = 0;
            }
            foreach($cart as $item) {
                $totalPrice += ($item->kaina * $item->quantity);
            }
            $invoiceInsert = Uzsakymas::create([
                'vartotojo_id' => Auth::user()->id,
                'kodas' => $this->generateRandomString(),
                'pvm' => ($item->kaina * $item->quantity) * 0.21,
                'nuolaida' => $totalPrice * $discount,
                'visa_suma' => $totalPrice - ($totalPrice * $discount)
            ]);
            $invoiceStatus = Busena::create([
                'uzsakymo_id' => $invoiceInsert->id,
                'atnaujinimo_laikas' => date("Y-m-d H:i:s"),
                'busena' => 1
            ]);
            $count = 0;
            foreach($cart as $item) {
                $itemInsert = UzsakymoPreke::create([
                    'prekes_id' => $item->id,
                    'uzsakymo_id' => $invoiceInsert->id,
                    'kiekis' => $item->quantity,
                    'kaina' => $item->kaina
                ]);
                if($itemInsert) {
                    $count++;
                }
            }
            $totalPrice = $totalPrice - ($totalPrice * $discount);
            if($invoiceInsert && count($cart) == $count && $invoiceStatus) {
                try {
                    $order = $invoiceInsert;
                    $user = Auth::user();
                    $status = $order->busena;
                    Mail::to($user->email)->queue(new StatusEmail($order, $user, $status));

                    $cents = round($totalPrice * 100, 0);
                    $redirect = WebToPay::redirectToPayment(array(
                        'projectid' => 195027,
                        'sign_password' => '27e161d5ee12613efe0a158c2687c1b1',
                        'orderid' => $invoiceInsert->id,
                        'amount' => $cents,
                        'currency' => 'EUR',
                        'p_firstname' => Auth::user()->vardas,
                        'p_lastname' => Auth::user()->pavarde,
                        'p_email' => Auth::user()->email,
                        'p_street' => $request->input('adresas'),
                        'p_city' => $request->input('miestas'),
                        'p_zip' => $request->input('pasto_kodas'),
                        'personcode' => Auth::id(),
                        'paytext' => 'Apmokėjimas už (#' . $invoiceInsert->id . ' sąskaitą), '. Auth::user()->email,
                        'country' => 'LT',
                        'accepturl' => url('/apmoketa'),
                        'cancelurl' => url('/neapmoketa'),
                        'callbackurl' => url('/callback'),
                        'test' => 1,
                    ));
                } catch (\WebToPayException $e) {
                    return Redirect::back()->with('error', $e->getMessage());
                }
            }
        }
    }

    public function callback() {
        try{
            $response = WebToPay::checkResponse($_POST, array(
                'projectid' => 195027,
                'sign_password' => '27e161d5ee12613efe0a158c2687c1b1',
                'test' => 1
            ));

            /*if($response['test'] !== '0'){
                throw new Exception('Testing, real payment was not made');
            }
            if($response['type'] !== 'macro'){
                throw new Exception('Only macro payment callbacks are accepted');
            }*/

            $orderId = $response['orderid'];

            if(Uzsakymas::where('id', $orderId)->first()->statusas < 3) {
                $invoiceStatus = Busena::create([
                    'uzsakymo_id' => $orderId,
                    'atnaujinimo_laikas' => date("Y-m-d H:i:s"),
                    'busena' => 2
                ]);

                // Gauna order ir jo kūrėją
                $order = Uzsakymas::where('id', $orderId)->first();
                $user = $order->vartotojas;
                $status = $order->busena;

                Mail::to($user->email)->queue(new StatusEmail($order, $user, $status));
            }

            echo 'OK';
        } catch (\WebToPayException $e) {
            echo get_class($e) . ':' . $e->getMessage();
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
