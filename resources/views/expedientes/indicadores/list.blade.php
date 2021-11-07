
<div class=" card m-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="font-weight-bold">@lang('indicador.titulo1')</span>
        <div>

            <a href="{{ route('expediente_indicadores_grafico',['id' => $pet->id])}}" class="btn btn-primary  float-right "><i class="fas fa-chart-line"></i> @lang('record.see_chart')</a>
            @role('Veterinario')
            <a href="{{route('expediente_indicadores_crear',['id' => $pet->id])}}" class="btn btn-primary  float-right mr-1 "><i class="fas fa-plus"></i> @lang('record.add')</a>

            @endrole
        </div>
    </div>
    <div class="card-body">
        @if(count($indicators)>0)
             
            <table class="table table-striped table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">@lang('indicador.fechaConsulta')</td>
                        <th scope="col">@lang('indicador.tipo') </td>
                        <th scope="col">@lang('indicador.valor') </td>
                        @role('Veterinario')<th scope="col">@lang('indicador.opciones')</th>@endrole
                    </tr>
                </thead>
                <tbody>
                
                @foreach($indicators as $i)
                    <tr>
                    <td> {{$i->fechaConsulta}} </td>
                    <td> @lang('indicador.tipo_indicador_'.$i->tipo)  </td>
                    <td> {{$i->valor}} </td>
                    @role('Veterinario')
                    <td>
                        <form method="POST" action="{{route('expediente_indicadores_delete', ['id' => $i->id])}}">
                            @csrf
                            <input type="hidden" name="registroId" value="">
                            <div class="btn-group">
                                <a href="{{route('expediente_indicadores_editar', ['id' => $i->id])}}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('indicador.boton_editar')</a>
                            </div>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> @lang('indicador.boton_eliminar')</button>
                        </form>
                    </td>
                    @endrole
                    </tr>
                @endforeach 
                </tbody>
            </table>
        @else
            <div class="alert alert-info mb-0">@lang('indicador.mensaje1')</div>
        @endif  
         {{$indicators->appends(['diseases' => $diseases->currentPage(), 'vaccines' => $vaccines->currentPage()])->links()}}   
    </div>
</div>