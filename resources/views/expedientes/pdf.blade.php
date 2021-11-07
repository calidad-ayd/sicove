<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style>
		td#border {
			border: 1px solid black;
		}
		table {
  border-collapse: collapse;
}
	</style>
<table style="width: 100%;">
	<tbody>
		<tr>
			<td rowspan="4" style="width: 54.507%;">
				<img src="https://sicovecr.pw/images/logo.png" style="width: 166px;" class="fr-fic fr-dib fr-fil">
			</td>
			<td style="width: 45.3428%; text-align: right;">
				<strong>Sicove CR</strong><br>
			</td>
		</tr>
		<tr>
			<td style="width: 45.3428%; text-align: right;">Cl&iacute;nica Veterinaria<br></td>
		</tr>
		<tr>
			<td style="width: 45.3428%; text-align: right;"><strong>Tel&eacute;fono</strong>: 8888-8888<br></td>
		</tr>
		<tr>
			<td style="width: 45.3428%; text-align: right;"><strong>Correo electronico</strong>: citas@sicovecr.pw<br></td>
		</tr>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<td style="width: 100%; text-align: center;"><strong><span style="font-size: 24px;">Expediente veterinario</span></strong><span style="font-size: 30px;"><br></span></td>
		</tr>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<td colspan="3" style="width: 100%;"><span style="font-size: 18px;"><strong>Datos b&aacute;sicos de la mascota</strong></span><br></td>
		</tr>
		<tr>
			<td rowspan="4" style="width: 23.1481%;">
				<img src="{{$foto}}" style="width: 131px;" class="fr-fic fr-dii fr-rounded"><br>
			</td>
			<td id="border" style="width: 14.2242%;">Nombre:<br></td>
			<td id="border" style="width: 62.5025%; text-align: left;">{{$pet->nombre}}<br></td>
		</tr>
		<tr>
			<td id="border" style="width: 14.2242%;">Propietario:<br></td>
			<td id="border" style="width: 62.5025%; text-align: left;">{{$pet->client->nombre}}<br></td>
		</tr>
		<tr>
			<td id="border" style="width: 14.2242%;">Raza:<br></td>
			<td id="border" style="width: 62.5025%; text-align: left;">{{$pet->raza}}<br></td>
		</tr>
		<tr>
			<td id="border" style="width: 14.2242%;">Edad:<br></td>
			<td id="border" style="width: 62.5025%; text-align: left;">{{$pet->age}}<br></td>
		</tr>
	</tbody>
</table>
<table style="width: 100%;margin-top:10px;">
	<tbody>
		<tr>
			<td style="width: 100.0000%;"><span style="font-size: 18px;"><strong>Enfermedades diagnosticadas</strong></span><br></td>
		</tr>
	</tbody>
</table>
@if(count($diseases)>0)
	 @foreach($diseases as $disease)
		<table style="width: 100%;margin-top:10px;border: 1px solid black;">
			<tbody>
				<tr>
					<td class="fr-thick" style="width: 29.4294%;"><strong>Enfermedad:</strong><br></td>
					<td class="fr-thick" style="width: 34.0841%;">{{$disease->disease->nombre}}<br></td>
					<td class="fr-thick" style="width: 21.479%;"><strong>Fecha diagn&oacute;stico:</strong><br></td>
					<td class="fr-thick" style="width: 14.8799%;">{{$disease->fecha_diagnostico}}<br>
					</td>
				</tr>
				<tr>
					<td class="fr-thick" style="width: 29.4294%;"><strong>Estado del avance:</strong><br></td>
					<td class="fr-thick" colspan="3" style="width: 70.4204%;">{{$disease->estado_avance}}<br></td>
				</tr>
			</tbody>
		</table>
		@if(count($disease->treatments)>0)
			<table style="width: 100%;margin-top: 10px;">
				<thead>
					<tr>
						<td style="width: 7.6577%;"><br></td>
						<td colspan="4" style="width: 92.1921%;"><strong>Tratamientos</strong><span style="font-size: 14px;"><br></span></td>
					</tr>
					<tr>
						<td style="width: 7.6577%;"><br></td>
						<td id="border" style="width: 27.1771%;"><strong>Fecha tratamiento</strong><br></td>
						<td id="border" style="width: 32.5526%;"><strong>Descripci&oacute;n</strong><br></td>
						<td id="border" style="width: 20.7808%;"><strong>Dosis</strong><br></td>
						<td id="border" style="width: 11.6517%;"><strong>Duraci&oacute;n</strong><br></td>
					</tr>

				</thead>
				<tbody>
					@foreach($disease->treatments as $treatment)
						<tr>
							<td style="width: 7.6577%;"><br></td>
							<td id="border" style="width: 27.1771%;">{{$treatment->created_at}}<br></td>
							<td id="border" style="width: 32.5526%;">{{$treatment->indicacion}}<br></td>
							<td id="border" style="width: 20.7808%;">{{$treatment->periodicidad}}<br></td>
							<td id="border" style="width: 11.6517%;">{{$treatment->finalizacion}}<br></td>
						</tr>

					@endforeach
				</tbody>
			</table>
		@endif
	 @endforeach
@else
	<div style="border: 1px solid black;">¡No hay enfermedades diagnosticadas registradas!</div>	 
@endif

<table style="width: 100%; margin-top:10px;">
	<tbody>
		<tr>
			<td style="width: 100.0000%;"><span style="font-size: 18px;"><strong>Vacunas aplicadas</strong></span><br></td>
		</tr>
	</tbody>
</table>
@if(count($vaccines)>0)
	<table style="width: 100%;margin-top: 10px;">
		<thead>
			<tr>
				<td id="border" style="width: 33.3333%;">Fecha de aplicaci&oacute;n<br></td>
				<td id="border" style="width: 33.3333%;">Nombre de la vacuna<br></td>
				<td id="border" style="width: 33.3333%;">Tipo de vacuna<br></td>
			</tr>
		</thead>
		<tbody>
		@foreach($vaccines as $vaccine)
			<tr>
				<td id="border" style="width: 33.3333%;">{{$vaccine->fecha_aplicacion}}<br></td>
				<td id="border" style="width: 33.3333%;">{{$vaccine->vaccine->nombre}}<br></td>
				<td id="border" style="width: 33.3333%;">{{$vaccine->vaccine->tipo}}<br></td>
			</tr>
		@endforeach
		</tbody>
	</table>
@else
	<div style="border: 1px solid black;">¡No hay vacunas aplicadas registradas!</div>
@endif
<table style="width: 100%;margin-top: 10px;">
	<tbody>
		<tr>
			<td style="width: 100.0000%;"><span style="font-size: 18px;"><strong>Indicadores F&iacute;sico-qu&iacute;micos</strong></span><br></td>
		</tr>
	</tbody>
</table>
<table style="width: 100%;margin-top: 10px;">
	<tbody>
		<tr>
			<td colspan="2" style="width: 99.8498%;"><strong>Peso (en kilogramos)</strong><br></td>
		</tr>
		@if(count($indicators_kg)>0)
			<tr>
				<td id="border" style="width: 50%;">Fecha medici&oacute;n<br></td>
				<td id="border" style="width: 50%;">Valor de la medici&oacute;n<br></td>
			</tr>
			@foreach($indicators_kg as $kg)
				<tr>
					<td id="border" style="width: 50%;">{{$kg->fechaConsulta}}<br></td>
					<td id="border" style="width: 50%;">{{$kg->valor}}<br></td>
				</tr>
			@endforeach
		@else
			<tr>
				<td id="border" style="width: 100%;">¡No hay mediciones de peso registradas!</td>
				<td></td>
			</tr>
		@endif	
	</tbody>
</table>
<table style="width: 100%;margin-top: 10px;">
	<tbody>
		<tr>
			<td colspan="2" style="width: 100.0000%;"><strong>Estatura (en cent&iacute;metros)</strong><br></td>
		</tr>
		@if(count($indicators_cm)>0)
			<tr>
				<td id="border" style="width: 50%;">Fecha medici&oacute;n<br></td>
				<td id="border" style="width: 50%;">Valor de la medici&oacute;n<br></td>
			</tr>
			@foreach($indicators_cm as $cm)
				<tr>
					<td id="border" style="width: 50%;">{{$kg->fechaConsulta}}<br></td>
					<td id="border" style="width: 50%;">{{$kg->valor}}<br></td>
				</tr>
			@endforeach
		@else
		<tr>
			<td id="border" style="width: 100%;">¡No hay mediciones de estatura registradas!</td>
			<td></td>
		</tr>
		@endif	
	</tbody>
</table>
<table style="width: 100%;margin-top: 10px;margin-bottom: 5px;">
	<tbody>
		<tr>
			<td colspan="2" style="width: 100.0000%;"><strong>Temperatura (en grados celsius)</strong><br></td>
		</tr>
		@if(count($indicators_gc)>0)
			<tr>
				<td id="border" style="width: 50%;">Fecha medici&oacute;n<br></td>
				<td id="border" style="width: 50%;">Valor de la medici&oacute;n<br></td>
			</tr>
			@foreach($indicators_gc as $gc)
				<tr>
					<td id="border" style="width: 50%;">{{$gc->fechaConsulta}}<br></td>
					<td id="border" style="width: 50%;">{{$gc->valor}}<br></td>
				</tr>
			@endforeach	
		@else
			<tr>
				<td id="border" style="width: 100%;">¡No hay mediciones de temperatura registradas!</td>
				<td></td>
			</tr>
		@endif
	</tbody>
</table>
<p>Este documento ha sido generado a solicitud del interesado el d&iacute;a {{$date}}, desde la plataforma digital de SICOVECR.</p>
@if(!is_null($start) && !is_null($end))
	<p>Período de consulta desde: {{$start}} hasta {{$end}}</p>
@endif
</body>
</html>