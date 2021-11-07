<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClientEventController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\DiseaseEntryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VaccineEntryController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\IndicadoresController;
use App\Http\Controllers\VeterinarioController;
use App\Http\Middleware\Translate;
use App\Http\Controllers\EnfermedadController;
use App\Http\Controllers\VacunaController;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'middleware' => 'Translate']);

Route::get('/', [HomeController::class, 'index'])->middleware('translate')->name('home');
Route::get('/servicios',[HomeController::class, 'services'])->middleware('translate')->name('servicios');
Route::get('/nosotros',[HomeController::class, 'us'])->middleware('translate')->name('nosotros');
Route::get('/dashboard', [HomeController::class, 'dev'])->middleware('auth', 'translate')->name('dashboard');
Route::post('/dashboard', [HomeController::class, 'search'])->middleware('auth', 'translate')->name('dashboard.search');

Route::group(['prefix' => 'clientes', 'middleware' => ['auth', 'translate']], function() {
	Route::get('/', [ClientController::class, 'index'])->middleware('role:Veterinario')->name('clients');
	Route::get('editar/{id}', [ClientController::class, 'edit'])->name('clients_edit');
	Route::post('editar/{id}', [ClientController::class, 'update'])->name('clients_update');
	Route::get('ver/{id}', [ClientController::class, 'show'])->name('clients_show');
	Route::get('crear', [ClientController::class, 'create'])->middleware('role:Veterinario')->name('clients_create');
	Route::post('crear', [ClientController::class, 'store'])->middleware('role:Veterinario')->name('clients_store');
});

Route::group(['prefix' => 'mascota', 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
	Route::get('editar/{id}', [PetController::class, 'edit'])->name('pet_edit');
	Route::post('editar/{id}', [PetController::class, 'update'])->name('pet_update');
	Route::get('crear/{id}', [PetController::class, 'create'])->name('pet_create');
	Route::post('crear/{id}', [PetController::class, 'store'])->name('pet_store');
	Route::post('eliminar/{id}', [PetController::class, 'destroy'])->name('pet_delete');
});

Route::group(['prefix' => 'veterinarios', 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
	Route::get('/', [VeterinarioController::class, 'index'])->name('veterinary_list');
	Route::get('crear', [VeterinarioController::class, 'create'])->name('veterinary_create');
	Route::post('crear', [VeterinarioController::class, 'store'])->name('veterinary_store');
	Route::get('editar/{id}', [VeterinarioController::class, 'edit'])->name('veterinary_edit');
	Route::post('editar/{id}', [VeterinarioController::class, 'update'])->name('veterinary_update');
});

Route::group(['prefix' => 'enfermedades' , 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
	Route::get('/', [EnfermedadController::class, 'index'])->name('diseases_list');
	Route::post('/', [EnfermedadController::class, 'destroy'])->name('diseases_destroy');
	Route::get('crear', [EnfermedadController::class, 'create'])->name('disease_create');
	Route::post('crear', [EnfermedadController::class, 'store'])->name('disease_store');
	Route::get('editar/{id}', [EnfermedadController::class, 'edit'])->name('disease_edit');
	Route::post('editar/{id}', [EnfermedadController::class, 'update'])->name('disease_update');
});

Route::group(['prefix' => 'vacunas', 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
	Route::get('/', [VacunaController::class, 'index'])->name('vaccines_list');
	Route::post('/', [VacunaController::class, 'destroy'])->name('vaccines_destroy');
	Route::get('crear', [VacunaController::class, 'create'])->name('vaccines_create');
	Route::post('crear', [VacunaController::class, 'store'])->name('vaccines_store');
	Route::get('editar/{id}', [VacunaController::class, 'edit'])->name('vaccines_edit');
	Route::post('editar/{id}', [VacunaController::class, 'update'])->name('vaccines_update');
});

Route::group(['prefix' => 'citas', 'middleware' => ['auth', 'translate', 'role:Cliente']], function() {
	Route::get('/', [ClientEventController::class, 'index'])->name('citas_index');
	Route::post('/', [ClientEventController::class, 'destroy'])->name('citas_destroy');
	Route::get('pendings', [ClientEventController::class, 'pendings'])->name('citas_pendings');
	Route::post('pendings', [ClientEventController::class, 'destroy'])->name('citas_destroy_pending');
});

Route::group(['prefix' => 'calendario', 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
    Route::get('miCalendario/{id}', [EventController::class, 'index'])->name('vet.calendario');
    Route::get('miCalendario/{id}/{month}',[EventController::class,'index_month'])->name('otroMes');
    Route::get('add/{id}/{date}', [EventController::class, 'create'])->name("vet.agendarCita");
    Route::post('add/{id}/{date}', [EventController::class, 'store']);
    Route::get('edit/{id_cita}', [EventController::class, 'edit'])->name("vet.editEvent");
    Route::post('edit/{id_cita}', [EventController::class, 'update']);
    Route::delete('edit/{id_cita}', [EventController::class, 'destroy']);
});

Route::group(['prefix' => 'expediente', 'middleware' => ['auth', 'translate']], function() {
	// general, envio correo y generar pdf
	Route::get('ver/{id}/{start?}/{end?}', [ExpedienteController::class, 'show'])->name('expediente_ver');
	Route::post('ver/periodos/{id}', [ExpedienteController::class, 'search'])->name('expediente_ver_periodos');
	Route::get('descargar/{id}/{start?}/{end?}', [ExpedienteController::class, 'pdf'])->name('expediente_descarga');

	Route::get('descargarTratamientos/{id}/{start?}/{end?}', [TreatmentController::class, 'pdf'])->name('imprimir_tratamiento');

	Route::get('email/{id}/{start?}/{end?}', [ExpedienteController::class, 'email'])->name('expediente_email');
	// enfermedades
	Route::group(['prefix' => 'enfermedades'], function() {
		Route::get('agregar/{id}', [DiseaseEntryController::class, 'create'])->middleware('role:Veterinario')->name('expediente_enfermedad_crear');
		Route::post('agregar/{id}', [DiseaseEntryController::class, 'store'])->middleware('role:Veterinario')->name('expediente_enfermedad_store');
		Route::post('eliminar/{id}', [DiseaseEntryController::class, 'destroy'])->middleware('role:Veterinario')->name('expediente_enfermedad_delete');
		Route::get('editar/{id}', [DiseaseEntryController::class, 'edit'])->middleware('role:Veterinario')->name('expediente_enfermedad_editar');
		Route::post('editar/{id}', [DiseaseEntryController::class, 'update'])->middleware('role:Veterinario')->name('expediente_enfermedad_update');
		Route::get('detalles/{id}', [DiseaseEntryController::class, 'show'])->name('expediente_enfermedad_detalles');
		Route::post('detalles/{id}', [TreatmentController::class, 'destroy'])->middleware('role:Veterinario')->name('expediente_tratamiento_delete');
		Route::get('tratamiento/agregar/{id}', [TreatmentController::class, 'create'])->middleware('role:Veterinario')->name('expediente_tratamiento_crear');
		Route::post('tratamiento/agregar/{id}', [TreatmentController::class, 'store'])->middleware('role:Veterinario')->name('expediente_tratamiento_store');
		Route::get('tratamiento/editar/{id}', [TreatmentController::class, 'edit'])->middleware('role:Veterinario')->name('expediente_tratamiento_edit');
		Route::post('tratamiento/editar/{id}', [TreatmentController::class, 'update'])->middleware('role:Veterinario')->name('expediente_tratamiento_store');
		Route::get('tratamiento/avances/{id}', [TreatmentController::class, 'list'])->name('expediente_tratamiento_advance');
	});

	// vacunas
	Route::group(['prefix' => 'vacunas', 'middleware' => ['auth', 'translate', 'role:Veterinario']], function() {
		Route::get('agregar/{id}', [VaccineEntryController::class, 'create'])->name('expediente_vacuna_crear');
		Route::post('agregar/{id}', [VaccineEntryController::class, 'store'])->name('expediente_vacuna_store');
		Route::post('eliminar/{id}', [VaccineEntryController::class, 'destroy'])->name('expediente_vacuna_destroy');
		Route::get('editar/{id}', [VaccineEntryController::class, 'edit'])->name('expediente_vacuna_editar');
		Route::post('editar/{id}', [VaccineEntryController::class, 'update'])->name('expediente_vacuna_update');
	});

	// indicadores
	Route::group(['prefix' => 'indicadores'], function() {
		Route::get('agregar/{id}', [IndicadoresController::class, 'create'])->middleware('role:Veterinario')->name('expediente_indicadores_crear');
		Route::post('agregar/{id}', [IndicadoresController::class, 'store'])->middleware('role:Veterinario')->name('expediente_indicadores_store');
		Route::post('eliminar/{id}', [IndicadoresController::class, 'destroy'])->middleware('role:Veterinario')->name('expediente_indicadores_delete');
		Route::get('editar/{id}', [IndicadoresController::class, 'edit'])->middleware('role:Veterinario')->name('expediente_indicadores_editar');
		Route::post('editar/{id}', [IndicadoresController::class, 'update'])->middleware('role:Veterinario')->name('expediente_indicadores_update');
		Route::get('grafico/{id}/{start?}/{end?}',[IndicadoresController::class,'highchart'])->name('expediente_indicadores_grafico');
		Route::post('grafico/periodos/{id}', [IndicadoresController::class, 'searchG'])->name('expediente_indicadores_grafico_post');
	});

	//Consulta
	Route::group(['prefix' => 'consultas'], function() {
		Route::get('agregar/{id}', [ConsultaController::class, 'create'])->middleware('role:Veterinario')->name('expediente_consulta_crear');
		Route::post('agregar/{id}', [ConsultaController::class, 'store'])->middleware('role:Veterinario')->name('expediente_consulta_store');
		Route::post('eliminar/{id}', [ConsultaController::class, 'destroy'])->middleware('role:Veterinario')->name('expediente_consulta_delete');
		Route::get('editar/{id}', [ConsultaController::class, 'edit'])->middleware('role:Veterinario')->name('expediente_consulta_editar');
		Route::post('editar/{id}', [ConsultaController::class, 'update'])->middleware('role:Veterinario')->name('expediente_consulta_update');
		Route::get('detalles/{id}', [ConsultaController::class, 'show'])->name('expediente_consulta_detalles');
	});
	
});

Route::get('/acknowledgment', [HomeController::class, 'acknowledgment'])->name('thanks')->middleware('translate');
Route::post('setLang', [HomeController::class, 'setLanguage'])->name('setLang')->middleware('auth');