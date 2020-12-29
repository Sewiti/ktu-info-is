<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Rezervacija;
use App\Models\Statusas;
use App\Models\Uzduotis;
use App\Models\Vartotojas;
use App\Models\Zinute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user_id = $user->id;

        if ($user->vartotojo_tipas == 2) {
            $uzduotys = DB::table('rezervacija')
                ->leftJoin('uzduotis', 'uzduotis.rezervacijos_id', 'rezervacija.id')
                ->leftJoin('nuotraukos', function ($join) {
                    $join->on('nuotraukos.nuotraukos_tipas', DB::raw("'2'"))
                        ->on('uzduotis.id', 'nuotraukos.prekes_paslaugos_id');
                })
                ->where('uzduotis.darbuotojas_id', $user_id)
                ->where('uzduotis.statusas', '!=', 2)
                ->get([
                    'uzduotis.*',
                    'rezervacija.pradzios_laikas',
                    'nuotraukos.url',
                ]);
        } else if ($user->vartotojo_tipas == 3) {
            $uzduotys = DB::table('rezervacija')
                ->leftJoin('uzduotis', 'uzduotis.rezervacijos_id', 'rezervacija.id')
                ->leftJoin('nuotraukos', function ($join) {
                    $join->on('nuotraukos.nuotraukos_tipas', DB::raw("'2'"))
                        ->on('uzduotis.id', 'nuotraukos.prekes_paslaugos_id');
                })
                ->where('uzduotis.statusas', '!=', 2)
                ->get([
                    'uzduotis.*',
                    'rezervacija.pradzios_laikas',
                    'nuotraukos.url',
                ]);
        } else if ($user->vartotojo_tipas == 1) {
            $uzduotys = DB::table('vartotojai')
                ->leftJoin('rezervacija', 'rezervacija.vartotojas_id', 'vartotojai.id')
                ->leftJoin('uzduotis', 'uzduotis.rezervacijos_id', 'rezervacija.id')
                ->leftJoin('nuotraukos', function ($join) {
                    $join->on('nuotraukos.nuotraukos_tipas', DB::raw("'2'"))
                        ->on('uzduotis.id', 'nuotraukos.prekes_paslaugos_id');
                })
                ->where('vartotojai.id', $user_id)
                ->where('uzduotis.statusas', '!=', 2)
                ->get([
                    'vartotojai.id as vartotojas_id',
                    'uzduotis.*',
                    'rezervacija.pradzios_laikas',
                    'nuotraukos.url',
                ]);
        }

        return view('tasks.index', ["uzduotys" => $uzduotys]);
    }

    public function create($date)
    {
        $employee = Vartotojas::select('vartotojai.*', DB::raw('IFNULL(aj.active_jobs, 0) AS active_jobs'))
            ->leftJoin(DB::raw("(
                SELECT `darbuotojas_id`, COUNT(`darbuotojas_id`) AS `active_jobs` FROM `uzduotis`
                WHERE `statusas` = 3
                GROUP BY `darbuotojas_id`
            ) AS `aj`"), 'aj.darbuotojas_id', 'vartotojai.id')
            ->where('vartotojo_tipas', 2)
            ->orderBy('active_jobs', 'ASC')
            ->orderBy('vartotojai.data_sukurta', 'ASC')
            ->first();

        return view('tasks.create', ["date" => $date, "employee" => $employee]);
    }

    public function store(Request $request, Vartotojas $employee)
    {
        // Naujos rezervacijos kurimas
        $rezervacija = new Rezervacija();
        $rezervacija->pradzios_laikas = $request->task_date;
        $rezervacija->vartotojas_id = auth()->user()->id;
        $rezervacija->save();

        // Naujos uzduoties kurimas
        $uzduotis = new Uzduotis();
        $uzduotis->pavadinimas = $request->name;
        $uzduotis->aprasas = $request->description;
        $uzduotis->data_sukurta = Carbon::now();
        $uzduotis->data_atnaujinta = Carbon::now();
        $uzduotis->darbuotojas_id = $employee->id;
        $uzduotis->rezervacijos_id = $rezervacija->id;
        $uzduotis->save();

        // Naujos nuotraukos pridejimas pagal rezervacijos id
        $imageName = time() . '.' . $request->main_image->extension();
        $request->main_image->move(public_path('images'), $imageName);

        $nuotrauka = new Image();
        $nuotrauka->url = 'images/' . $imageName;
        $nuotrauka->prekes_paslaugos_id = $rezervacija->id;
        $nuotrauka->nuotraukos_tipas = 2;
        $nuotrauka->data_sukurta = Carbon::now();
        $nuotrauka->data_atnaujinta = Carbon::now();
        $nuotrauka->save();

        return redirect(url('/kalendorius'));
    }

    public function showCalendar()
    {
        $rezervacijos = DB::table('rezervacija')->select(DB::raw('CONVERT(pradzios_laikas, DATE) pradzios_laikas'))
            ->where('statusas', 5)
            ->get();

        return view('calendar', ["rezervacijos" => $rezervacijos]);
    }

    public function show($task)
    {
        $uzduotis = DB::table('rezervacija')
            ->leftJoin('uzduotis', 'uzduotis.rezervacijos_id', 'rezervacija.id')
            ->leftJoin('nuotraukos', function ($join) {
                $join->on('nuotraukos.nuotraukos_tipas', DB::raw("'2'"))
                    ->on('nuotraukos.prekes_paslaugos_id', 'uzduotis.id');
            })
            ->where('rezervacija.id', $task)
            ->first([
                'uzduotis.*',
                'rezervacija.pradzios_laikas',
                'nuotraukos.url',
                'rezervacija.vartotojas_id',
            ]);

        $darbuotojas = DB::table('vartotojai')->select()->where('id', $uzduotis->darbuotojas_id)->first();

        return view('tasks.show', ["uzduotis" => $uzduotis, "darbuotojas" => $darbuotojas]);
    }

    public function destroy($task)
    {
        Uzduotis::where('id', $task)->update([
            'statusas' => 2
        ]);

        Rezervacija::where('id', $task)->update([
            'statusas' => 2
        ]);

        return redirect(route('tasks.index'));
    }

    public function edit($task)
    {
        $uzduotis = Uzduotis::all()->where('id', $task)->first();

        $rezervacija = Rezervacija::all()->where('id', $task)->first();

        $nuotrauka = Image::all()->where('nuotraukos_tipas', 2)->where('prekes_paslaugos_id', $task);

        $statusai = Statusas::all();

        return view('tasks.edit', [
            "uzduotis" => $uzduotis,
            "rezervacija" => $rezervacija,
            "nuotrauka" => $nuotrauka,
            "statusai" => $statusai
        ]);
    }

    public function update($task, Request $request)
    {
        // dd($request->statusas);


        if ($request->statusas != null && $request->pavadinimas != null && $request->aprasas != null) {
            Uzduotis::where('id', $task)->update([
                'pavadinimas' => $request->pavadinimas,
                'aprasas' => $request->aprasas,
                'statusas' => $request->statusas == 5 ? 3 : $request->statusas,
                'data_atnaujinta' => Carbon::now()
            ]);
        } else if ($request->statusas == null && $request->pavadinimas != null && $request->aprasas != null) {
            Uzduotis::where('id', $task)->update([
                'pavadinimas' => $request->pavadinimas,
                'aprasas' => $request->aprasas,
                'statusas' => 3,
                'data_atnaujinta' => Carbon::now()
            ]);
        } else {
            if ($request->statusas != null && $request->pavadinimas == null && $request->aprasas == null) {
                Uzduotis::where('id', $task)->update([
                    'statusas' => $request->statusas == 5 ? 3 : $request->statusas,
                    'data_atnaujinta' => Carbon::now()
                ]);
            } else {

                Uzduotis::where('id', $task)->update([
                    'data_atnaujinta' => Carbon::now()
                ]);
            }
        }

        if ($request->statusas) {
            Rezervacija::where('id', $task)->update([
                'statusas' => $request->statusas
            ]);
        }

        return redirect(route('tasks.show', ["task" => $task]));
    }

    public function comms($recipientId)
    {
        $userId = Auth::id();
        $recipient = Vartotojas::findOrFail($recipientId);

        $messages = Zinute::where(function ($query) use ($userId, $recipientId) {
            $query->where('siuncia', $userId)
                ->where('gauna', $recipientId);
        })->orWhere(function ($query) use ($userId, $recipientId) {
            $query->where('siuncia', $recipientId)
                ->where('gauna', $userId);
        })->orderBy('data_sukurta', 'ASC')
            ->get();

        // foreach ($messages as $message) {
        //     if ($message->gauna == $userId) {
        //         $message->status = 2;
        //         $message->save();
        //     }
        // }

        return view('tasks.comms', [
            'recipient' => $recipient,
            'messages' => $messages,
        ]);
    }


    public function commsStore()
    {
        $data = request()->validate([
            'recipientId' => 'required|integer|min:0',
            'message' => 'max:500',
        ]);
        if ($data['message'] == '') {
            return redirect(route('messages.show', ['recipientId' => $data['recipientId']]));
        }

        $recipientId = Vartotojas::findOrFail($data['recipientId'])->id;
        $userId = Auth::id();
        if ($recipientId == $userId) {
            return abort(404); // TODO: should be 400?
        }

        $message = new Zinute();
        $message->tekstas = $data['message'];
        $message->siuncia = $userId;
        $message->gauna = $recipientId;
        $message->save();

        return redirect(route('tasks.comms', ['recipientId' => $data['recipientId']]));
    }
}
