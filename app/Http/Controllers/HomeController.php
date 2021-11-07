<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Veterinary;
use App\Models\User;
use Auth;
use App\Models\Client;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.main');
    }

    public function services()
    {

      return view('home.services');
    }

    public function us()
    {

      return view ('home.nosotros');
    }

    public function dev()
    {
      $view = 'client';
      $agenda=[];
      $countables = [];
      if (Auth::user()->hasRole('Veterinario')) {
          $countables = [
            'clients' => Client::all()->count(),
            'pets' => Pet::all()->count(),
            'appointments' => Event::whereMonth('fechaCita', Carbon::now('America/Costa_Rica'))->count()
          ];
          $view = 'index';
          $horaInicial = date("H")-1; 
          $horaInicial=$horaInicial.":00:00" ;
          $agenda = Event::where("veterinary_id", Auth::user()->veterinary->id)->where("fechaCita","=",date("Y:m:d"))->where("estado",0)->where("horaCita",">",$horaInicial)->orderBy('horaCita')->get();
      } else {
          $appointments = [];
          $treatments = [];
          $pending = Pet::where('client_id', Auth::user()->client->id)->get();
          foreach ($pending as $p) {
            foreach ($p->eventsPending as $e) {
              $appointments[] = $e;
            }
          }
        $countables = [
          'appointments' => $appointments
        ];

      }

      return view('dashboard.'.$view, ['agenda' => $agenda, 'countable' => $countables]);
    }

    public function acknowledgment() {
      return view('acknowledgment.index');
    }

    public function search(Request $request)
    {
      $client_id = $request->client_id;
      $client = Client::find($client_id);
      if ($client) {
        return redirect()->route('clients_show', ['id' => $client->id]);
      } else {
        return redirect()->route('dashboard')->with('error', 'clients.route');
      }
    }

    public function setLanguage(Request $request)
    {
      $user = User::find(auth()->user()->id);
      $user->language = $request->lang;
      $user->save();
      return redirect()->back();
    }
}
