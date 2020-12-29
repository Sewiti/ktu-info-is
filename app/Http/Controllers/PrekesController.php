<?php

namespace App\Http\Controllers;

use App\Models\Kategorijos;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Prekes;
use Illuminate\Support\Facades\DB;

class PrekesController extends Controller
{
    public function index()
    {
        $prekes = Prekes::all();

        $categories = Kategorijos::all();

        return view('items.index', compact('prekes', 'categories'));
    }

    public function create()
    {
        $status = DB::select('SELECT * FROM `prekes_statusas` WHERE 1');
        $categories = Kategorijos::all();

        return view('items.create', compact('status', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData();

        $imageName = time() . '.' . $request->pagrindine_nuotrauka->extension();

        $request->pagrindine_nuotrauka->move(public_path('images'), $imageName);

        $data['pagrindine_nuotrauka'] = 'images/' . $imageName;

        $preke = Prekes::create($data);

        $nuotrauka = [
            'url' => $data['pagrindine_nuotrauka'],
            'prekes_paslaugos_id' => $preke['id'],
            'nuotraukos_tipas' => 1,
        ];

        Image::create($nuotrauka);

        return redirect(route('prekes.show', ['item' => $preke->id]));
    }

    public function show(Prekes $item)
    {
        $images = DB::select('SELECT * FROM `nuotraukos` WHERE nuotraukos_tipas = 1 AND  prekes_paslaugos_id = ' . $item->id);

        foreach ($images as $key => $value) {
            if ($value->url == $item->pagrindine_nuotrauka)
                unset($images[$key]);
        }

        return view('items.show', compact('item', 'images'));
    }

    public function destroy(Prekes $item)
    {
        $item->delete();

        return redirect(route('prekes.index'));
    }

    public function edit(Prekes $item)
    {
        $status = DB::select('SELECT * FROM `prekes_statusas` WHERE 1');
        $categories = Kategorijos::all();

        return view('items.edit', compact('item', 'status', 'categories'));
    }

    public function update(Prekes $item)
    {
        $data = $this->validatedData();

        $item->update($data);

        return redirect(route('prekes.show', ['item' => $item->id]));
    }

    private function validatedData()
    {
        return request()->validate([
            'pavadinimas' => 'required',
            'kategorija' => 'required',
            'aprasas' => 'required',
            'kaina' => 'required|numeric',
            'statusas' => 'required',
        ]);
    }
}
