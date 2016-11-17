@extends('adminlte::page') 

@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>CRIAR NOVO BLOCO</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('bloco.index') }}"> Voltar</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> Houve algum problema ao salvar.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(array('route' => 'bloco.store','method'=>'POST')) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome do bloco:</strong>
                {!! Form::text('nome_bloco', null, array('placeholder' => 'Nome do bloco','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantidade de unidades:</strong>
                {!! Form::text('quantidade_unidade', null, array('placeholder' => 'Quantidade de unidades','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Salvar</button>
        </div>
	</div>
	{!! Form::close() !!}
@endsection