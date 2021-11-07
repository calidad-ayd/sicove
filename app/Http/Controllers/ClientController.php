<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendUserLoginDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Client::paginate(10);
        return view('clients.list', ['clients' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'cedula.required' =>'clients.ced',
            'fecha_de_nacimiento.required' =>'pet.fecha_de_nacimiento_required',
            'nombre.required'=>'veterinario.nombre_require',
            'primer_apellido.required' => 'veterinario.primer_require',
            'segundo_apellido.required' => 'veterinario.segundo_require',
            'telefono.required' => 'veterinario.tel_require',
            'correo.required' => 'veterinario.correo_require',
            'fecha_de_nacimiento.before' => 'pet.fecha_de_nacimiento_before',
            'correo.email' =>'veterinario.mail',
        ];

        $validator = Validator::make($request->all(), [
        'cedula' => 'required',
        'nombre' => 'required',
        'primer_apellido' => 'required',
        'segundo_apellido' => 'required',
        'correo' => 'required|email:rfc,dns',
        'telefono' => 'required',
        'fecha_de_nacimiento' => 'required|before:tomorrow'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('clients_create')->withErrors($validator)->withInput();
        }else{

            $cliente = new Client;
            $cliente->id = $request->cedula;
            $cliente->nombre = $request->nombre;
            $cliente->primerApellido = $request->primer_apellido;
            $cliente->segundoApellido = $request->segundo_apellido;
            $cliente->correo = $request->correo;
            $cliente->telefono = $request->telefono;
            $cliente->fechaNacimiento = $request->fecha_de_nacimiento;
            $cliente->save();

            if ($cliente) {
                $user = new User;
                $user->name = $cliente->nombre." ". $cliente->primerApellido. " " . $cliente->segundoApellido;
                $user->email = $cliente->correo;
                $temporal_password = bin2hex(openssl_random_pseudo_bytes(8));
                $user->password =  Hash::make($temporal_password);
                $user->save();

                if ($user)
                {
                    $user->assignRole('cliente');
                    SendUserLoginDetails::dispatch($user, $temporal_password);
                }
            }
            
            return redirect()->route('clients')->with('message', 'clients.add_succesful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return view('errors.notFound');
        }
        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $client = Client::find($id);
        if (!$client) {
            return view('errors.notFound');
        }
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $messages = [
            'cedula.required' =>'clients.ced',
            'fecha_de_nacimiento.required' =>'pet.fecha_de_nacimiento_required',
            'nombre.required'=>'veterinario.nombre_require',
            'primer_apellido.required' => 'veterinario.primer_require',
            'segundo_apellido.required' => 'veterinario.segundo_require',
            'telefono.required' => 'veterinario.tel_require',
            'correo.required' => 'veterinario.correo_require',
            'fecha_de_nacimiento.before' => 'pet.fecha_de_nacimiento_before',
            'correo.email' =>'veterinario.mail',
        ];

        $validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'primer_apellido' => 'required',
        'segundo_apellido' => 'required',
        'correo' => 'required|email:rfc,dns',
        'telefono' => 'required|max:15',
        'fecha_de_nacimiento' => 'required|before:tomorrow'
        ], $messages);
        
        $cliente = Client::find($id);

        if($validator->fails()){
            return redirect()->route('clients_edit', ['id' => $id])->withErrors($validator)->withInput();
        }else{

            if ($cliente) {

                $lastEmail = $cliente->correo;

                $cliente->id = $request->cedula;
                $cliente->nombre = $request->nombre;
                $cliente->primerApellido = $request->primer_apellido;
                $cliente->segundoApellido = $request->segundo_apellido;
                $cliente->correo = $request->correo;
                $cliente->telefono = $request->telefono;
                $cliente->fechaNacimiento = $request->fecha_de_nacimiento;
                $cliente->save();

                $user = User::where('email', '=', $lastEmail)->first();
               
                $user->name = $cliente->nombre.' '.$cliente->primerApellido.' '.$cliente->segundoApellido;

                if ($lastEmail!=$cliente->correo) {
                    $user->email = $cliente->correo;
                }
                
                $user->save();

            }
            if (Auth::user()->hasRole('Veterinario')) {
                return redirect()->route('clients')->with('message', 'clients.edit_succesful'); 
            } else {
                return redirect('dashboard');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
