@role('Veterinario')
	@include('shared.menu-veterinario')
@else
	@include('shared.menu-cliente')
@endrole