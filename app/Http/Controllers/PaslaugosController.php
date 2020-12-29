<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Paslauga;
use Illuminate\Support\Facades\DB;

class PaslaugosController extends Controller
{
    // public function index()
    // {
    //     $prekes = Prekes::all();

    //     $categories = Category::all();

    //     return view('items.index', compact('prekes', 'categories'));
    // }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData();

        $imageName = time() . '.' . $request->main_image->extension();

        $request->main_image->move(public_path('images'), $imageName);

        $data['main_image'] = 'images/' . $imageName;

        $paslauga = Paslauga::create($data);

        return redirect(route('paslaugos.show', ['task' => $paslauga->id]));
    }

    // public function show(Prekes $item)
    // {
    //     $images = DB::select('SELECT * FROM `images` WHERE item_id = ' . $item->id);

    //     foreach ($images as $key => $value) {
    //         if ($value->url == $item->main_image)
    //             unset($images[$key]);
    //     }

    //     return view('items.show', compact('item', 'images'));
    // }

    // public function destroy(Prekes $item)
    // {
    //     $item->delete();

    //     return redirect(route('prekes.index'));
    // }

    // public function edit(Prekes $item)
    // {
    //     $status = DB::select('SELECT * FROM `prekes_statusas` WHERE 1');
    //     $categories = Category::all();

    //     return view('items.edit', compact('item', 'status', 'categories'));
    // }

    // public function update(Prekes $item, Request $request)
    // {
    //     $data = $this->validatedData();

    //     $imageName = time() . '.' . $request->main_image->extension();

    //     $request->main_image->move(public_path('images'), $imageName);

    //     $data['main_image'] = 'images/' . $imageName;

    //     $item->update($data);

    //     return redirect(route('prekes.show', ['item' => $item->id]));
    // }

    private function validatedData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }
}
