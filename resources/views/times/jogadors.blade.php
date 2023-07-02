@extends('times.tela.telas')

@section('parte')
<title>Jogador</title>

	<div class="text-left mt-3 mb-4">
	@if(session('mensagem'))
		<div class="alert alert-danger text-center mt-4 mb-4 p-2">
			<p>{{session('mensagem')}}</p>
		</div>
	@endif
	<div class="col-10 m-auto">
	<div input-group class="card" >

		@if(!empty($id))
			<form name="formEdit" id="formEdit" method="put" action="{{ route("jogador.edita", ['id' => $id, 'time' => $time]) }}">
				@method('PUT')
		@else
			<form name="formCadastro" id="formCadastro" method="post" action="{{route("jogador.salva")}}">
		@endif
		@csrf

	<!-- <form class="row g-3 conterner"  method="post"  action="{{url('cadastrojogador')}}"  > -->
	
        <div class="card-header text-left">{{ __('Cadastrar Jogador') }}</div>
		<div class="col-9 m-auto">
			<label for="nome" class="form-label" >Nome:</label>
			
			<input
				type="text"
				class="text45Left form-control"
				id="inNome"
				name='inNome'
				value="{{$jogador[0]['nome'] ?? ''}}"
				placeholder="Nome"
				required
				
			>

			<label for="nome" class="form-label">Apelido:</label>
			<input
				type="text"
				class="text45Left form-control"
				id="inApelido"
				name='inApelido'
				value="{{$jogador[0]['apelido'] ?? ''}}"
				placeholder="Apelido"
				required
			>

			<label for="cpf" class="form-label">CPF:</label>
			<input
				type="cpf"
				class="text45Left form-control cpf"
				id="inCpf"
				name='inCpf'
				value="{{$jogador[0]['cpf'] ?? ''}}"
				placeholder="***.***.***-**"
				required
			>

			<label for="telefone" class="form-label">Telefone:</label>
			<input
				type="text"
				class="text45Left form-control telefone"
				id="inTelefone"
				name='inTelefone'
				value="{{$jogador[0]['telefone'] ?? ''}}"
				placeholder="( ) - ---- ----"
			>

			<label for="inData" class="form-label">Data de nacimento:</label>
			<input
				type="date"
				class="text45Left form-control"
				name="inData"
				id="inData"
				value="{{$jogador[0]['nacimento'] ?? ''}}"
				placeholder="DD/MM/AAAA"
				max="9999-12-31"
				required
			>
			<br>
			<div class="col-10-auto">
			<button type="submit" class="btn btn-primary col-12 btn-size-120">Salvar</button>  
			
			
		</div>
		</div>

			
	</form>
				<form action="{{ route('jogador.index') }}"  ><a>
				<div class="col-9 m-auto">
				<div input-group class=" text-center" >
					<div class="col-10-auto">
                <button  class="btn btn-warning col-12 btn-size-120">Cancelar</button>
					</div>
				</div>
				</div>
            </a></form>
	</div>
<br>
@endsection('parte')
