<?php

namespace App\Http\Controllers;

use App\Models\Veterinary;
use App\Models\Client;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Jobs\SendMailEmployee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VeterinarioController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['role:Veterinario']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuaminate\Http\Response
     */
    public function index()
    {
        $veterinario = Veterinary::paginate(10);
        return view('veterinarios.index', ['veterinarios' => $veterinario]);
    }

    public function create()
    {
        return view('veterinarios.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'codigo.required' =>'veterinario.code_require',
            'nombre.required' =>'veterinario.nombre_require',
            'primer_apellido.required' =>'veterinario.primer_require',
            'segundo_apellido.required' =>'veterinario.segundo_require',
            'correo.required' =>'veterinario.correo_require',
            'telefono.required' =>'veterinario.tel_require',
            'codigo.numeric' =>'veterinario.code_numeric',
            'telefono.max' =>'veterinario.max',
            'mail.email' =>'veterinario.mail',
        ];

        $validator = Validator::make($request->all(), [
        'codigo' => 'required|numeric',
        'nombre' => 'required',
        'primer_apellido' => 'required',
        'segundo_apellido' => 'required',
        'correo' => 'required|email:rfc,dns',
        'telefono' => 'required|max:15'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('veterinary_create')->withErrors($validator)->withInput();
        }else{

            $veterinario = new Veterinary;
            $veterinario->id = $request->codigo;
            $veterinario->nombre = $request->nombre;
            $veterinario->primerApellido = $request->primer_apellido;
            $veterinario->segundoApellido = $request->segundo_apellido;
            $veterinario->correo = $request->correo;
            $veterinario->telefono = $request->telefono;
            $veterinario->save();

            if ($veterinario) {
                $user = new User;
                $user->name = $veterinario->nombre." ". $veterinario->primerApellido. " " . $veterinario->segundoApellido;
                $user->email = $veterinario->correo;
                $temporal_password = bin2hex(openssl_random_pseudo_bytes(8));
                $user->password =  Hash::make($temporal_password);
                $user->save();

                if ($user)
                {
                    $user->assignRole('veterinario');
                    SendMailEmployee::dispatch($user, $temporal_password);
                }
            }

            return redirect()->route('veterinary_list')->with('message', 'veterinario.add_redirect');
        }
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'codigo.required' =>'veterinario.code_require',
            'nombre.required' =>'veterinario.nombre_require',
            'primer_apellido.required' =>'veterinario.primer_require',
            'segundo_apellido.required' =>'veterinario.segundo_require',
            'correo.required' =>'veterinario.correo_require',
            'telefono.required' =>'veterinario.tel_require',
            'codigo.numeric' =>'veterinario.code_numeric',
            'telefono.max' =>'veterinario.max',
            'mail.email' =>'veterinario.mail',
        ];

        $validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'primer_apellido' => 'required',
        'segundo_apellido' => 'required',
        'correo' => 'required|email:rfc,dns',
        'telefono' => 'required|max:15'
        ], $messages);

        $veterinario = Veterinary::find($id);
        if ($veterinario) {
            if($validator->fails()){
                return redirect()->route('veterinary_edit', ['id' => $id])->withErrors($validator)->withInput();
            }else{
                $lastEmail = $veterinario->correo;


               // $veterinario = new Veterinary;
               // $veterinario->id = $request->codigo;
                $veterinario->nombre = $request->nombre;
                $veterinario->primerApellido = $request->primer_apellido;
                $veterinario->segundoApellido = $request->segundo_apellido;
                $veterinario->correo = $request->correo;
                $veterinario->telefono = $request->telefono;
                $veterinario->save();

                $user = User::where('email', '=', $lastEmail)->first();
               
                $user->name = $veterinario->nombre.' '.$veterinario->primerApellido.' '.$veterinario->segundoApellido;

                if ($lastEmail!=$veterinario->correo) {
                    $user->email = $veterinario->correo;
                }
                
                $user->save();
                /*if ($veterinario) {
                    $user = new User;
                    $user->name = $veterinario->nombre." ". $veterinario->primerApellido. " " . $veterinario->segundoApellido;
                    $user->email = $veterinario->correo;
                    $temporal_password = bin2hex(openssl_random_pseudo_bytes(8));
                    $user->password =  Hash::make($temporal_password);
                    $user->save();

                    if ($user)
                    {
                        $user->assignRole('veterinario');
                        SendMailEmployee::dispatch($user, $temporal_password);
                    }
                }*/

                return redirect()->route('veterinary_list')->with('message', 'veterinario.edit_redirect');
            }
        }
        
    }

    
    public function edit($id) {
        $veterinario = Veterinary::find($id);
        return view('veterinarios.edit', ['veterinary' => $veterinario]);
    }

}
