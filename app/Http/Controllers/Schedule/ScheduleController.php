<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use Carbon\Carbon;
use App\Service;
use App\Client;
use App\Http\Requests\Schedule\ScheduleFormRequest;

class ScheduleController extends Controller
{

    private $months = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março' , 4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
        7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('date', '=', Carbon::now()->format('Y-m-d'))
                   ->orderBy('hour', 'asc')
                   ->get();

        $dataHoje = Carbon::now()->format('d/m/Y'); 
        
        return view('schedules.index')->with(compact('schedules','dataHoje'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::select('id','name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name','id');
        
        $services = Service::select('id','name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name','id');

        return view('schedules.create')->with(compact('clients','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleFormRequest $request)
    {
        Schedule::create($request->all());

        return redirect()
            ->route('agendas.index')
            ->with(['success' => 'Agenda cadastrada com sucesso!']);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        $clients = Client::select('id','name')
        ->orderBy('name', 'asc')
        ->get()
        ->pluck('name','id');
    
        $services = Service::select('id','name')
        ->orderBy('name', 'asc')
        ->get()
        ->pluck('name','id');

        return view('schedules.edit')->with(compact('schedule', 'clients', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleFormRequest $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->fill($request->all());
        $schedule->save();

        $date = $schedule->date;
        $dataHoje = Carbon::parse($date)->format('d/m/Y');
        $schedules = null;

        $clients = Client::select('id','name')
        ->orderBy('name', 'asc')
        ->get()
        ->pluck('name','id');
    
        $services = Service::select('id','name')
        ->orderBy('name', 'asc')
        ->get()
        ->pluck('name','id');

        $schedules = Schedule::where('date', '=', $date)
            ->orderBy('hour', 'asc')
            ->get();

        return redirect()
            ->route('agendas.index')
            ->with(['success' => 'Agenda alterada com sucesso!']);
       
    }

    public function search($date)
    {
        if(!empty($date)) {
            $schedules = Schedule::where('date', '=', Carbon::parse($date)->format('Y-m-d'))->orderBy('hour', 'asc')->get();
        } else {
            $schedules = Schedule::where('date', '=', Carbon::now()->format('Y-m-d'))->orderBy('hour', 'asc')->get();
        }

        $clients = Client::get()->pluck('name', 'id');

        $services = Service::get()->pluck('name', 'id');

        return ['schedules'=>$schedules, 'clients'=>$clients, 'services'=>$services];
    }

    public function busca()
    {
        return view('schedules.busca');
    }

    public function buscar(Request $request)
    {
        $date = $request->get('date');
        $dataHoje = Carbon::parse($date)->format('d/m/Y');
        $schedules = null;

        $clients = Client::select('id','name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name','id');

        $services = Client::select('id','name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name','id');

        if(!empty($date)) {
            $schedules = Schedule::where('date', '=', $date)
                ->get();
        }
        return view('schedules.index')->with(compact('schedules','dataHoje', 'clients', 'services'));
    }

    public function agendamentosServico()
    {
        $feminino =Schedule::where('service_id', '=', 1)
            ->get()
            ->count();

        $femininoTintura = Schedule::where('service_id', '=', 2)
            ->get()
            ->count();

        $tinturaComTinta = Schedule::where('service_id', '=', 3)
            ->get()
            ->count();
    
        $tinturaSemTinta = Schedule::where('service_id', '=', 4)
            ->get()
            ->count();

        $masculinoMaquina = Schedule::where('service_id', '=', 5)
            ->get()
            ->count();

        $masculinoTesoura = Schedule::where('service_id', '=', 6)
            ->get()
            ->count();

        $pe = Schedule::where('service_id', '=', 7)
            ->get()
            ->count();
       
        $mao = Schedule::where('service_id', '=', 8)
            ->get()
            ->count();

        $maoPe = Schedule::where('service_id', '=', 9)
            ->get()
            ->count();

        $luzes = Schedule::where('service_id', '=', 10)
            ->get()
            ->count();

        $progressiva = Schedule::where('service_id', '=', 11)
            ->get()
            ->count();

        $escova = Schedule::where('service_id', '=', 12)
            ->get()
            ->count();

        $megaHair = Schedule::where('service_id', '=', 13)
            ->get()
            ->count();

        $chapinha = Schedule::where('service_id', '=', 14)
            ->get()
            ->count();



        $agendamentos = ["feminino"              => $feminino,
                         "femininoTintura"       => $femininoTintura,
                         "tinturaComTinta"       => $tinturaComTinta,
                         "tinturaSemTinta"       => $tinturaSemTinta,   
                         "masculinoMaquina"      => $masculinoMaquina,
                         "masculinoTesoura"      => $masculinoTesoura,
                         "pe"                    => $pe,
                         "mao"                   => $mao,
                         "maoPe"                 => $maoPe,
                         "luzes"                 => $luzes,
                         "progressiva"           => $progressiva,
                         "escova"                => $escova,
                         "megaHair"              => $megaHair,
                         "chapinha"              => $chapinha
        ];

        return response()->json($agendamentos);

    }

    public function totalRecebidoMes()
    {
        $recebimentos = [];

        if (Carbon::now()->month < 7) {
            for ($i = 1; $i<= Carbon::now()->month; $i++) {
                $totalRecebidoMes = Schedule::whereMonth('created_at', $i)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('value');
                $downloads[] = ['y' => $this->months[$i], 'a' => $totalRecebidoMes];
            }
            for ($i = count($recebimentos) + 1; $i<= 6; $i++) {
                $recebimentos[] = ['y' => $this->months[$i], 'a' => 0];
            }
        } else {
            for ($i = Carbon::now()->month - 5; $i<= Carbon::now()->month; $i++) {
                $totalRecebidoMes = Schedule::whereMonth('created_at', $i)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('value');
                $recebimentos[] = ['y' => $this->months[$i], 'a' => $totalRecebidoMes];
            }
        }

        return response()->json($recebimentos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        $schedule->delete();

        \Session::flash('success', 'Agenda ' . $schedule->hour . ' apagada com sucesso.');

        return response()->json(['message' => 'Agenda ' . $schedule->hour . ' apagada com sucesso.']);
    }
}
