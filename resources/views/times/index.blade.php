@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Time</title>
</head>
<body>
    @if(session('mensagem'))
		<div class="alert alert-success text-center mt-4 mb-4 p-2">
			<p>{{session('mensagem')}}</p>
		</div>
    @endif
	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
            <h1>Gerenciar Times</h1>
        </div>
    </div>

    <div class="text-center col-8 m-auto">
        <a href="{{ route('time.cadastrar',['idUsuario' => Auth::user()->id]) }}">
            <button class="btn btn-outline-success">Criar Novo Time</button>
        </a>
    </div>

    <div class="col-8 m-auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sigla</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($times as $time)
                        <?php
                            if ($time['Eexcluido'] == 0) {
                                $desab=null;
                                $style = null;
                                $texto = 'Desativar';
                                $cor = 'danger';
                                $rota = 'desativar';
                            } else {
                                $texto = 'Ativar';
                                $cor = 'success';
                                $rota = 'ativar';
                                $desab='disabled';
                                $style='pointer-events: none';
                            }
                        ?>
                        <tr>
                            <th scope="row">{{$time['sigla']}}</th>
                            <td>{{$time['nome']}}</td>
                            <td>{{$time['Eexcluido'] == 0 ? 'Ativo' : 'Inativo'}}</td>
                            <td>
                                <div input-group>
                                    <a style= "<?php echo $style ?>"href="{{ route('time.gerenciar',['idTime' => $time['id']]) }}">
                                        <button class="btn btn-primary btn-size-120" <?php echo $desab?>>Gerenciar</button>
                                    </a>
                                    <a href="{{ route('time.ativarDesativar',['idTime' => $time['id']]) }}">
                                        <button class="btn btn-{{$cor}} btn-size-120">{{$texto}}</button>
                                    </a>
                                    <a href="{{ route('time.editar',['idTime' => $time['id']]) }}">
                                    <button class="btn btn-warning btn-size-120">Editar Time</button>

                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        
@endsection
