@extends('layouts.app')

 

@section('content')

	<div class="row">

	    <div class="col-lg-12 margin-tb">

	        <div class="pull-left">

	            <h2>blocos CRUD</h2>

	        </div>

	        <div class="pull-right">

	        	@permission('bloco-create')

	            <a class="btn btn-success" href="{{ route('bloco.create') }}"> Create New bloco</a>

	            @endpermission

	        </div>

	    </div>

	</div>

	@if ($message = Session::get('success'))

		<div class="alert alert-success">

			<p>{{ $message }}</p>

		</div>

	@endif

	<table class="table table-bordered">

		<tr>

			<th>No</th>

			<th>Title</th>

			<th>Description</th>

			<th width="280px">Action</th>

		</tr>

	@foreach ($blocos as $key => $bloco)

	<tr>

		<td>{{ ++$i }}</td>

		<td>{{ $bloco->title }}</td>

		<td>{{ $bloco->description }}</td>

		<td>

			<a class="btn btn-info" href="{{ route('bloco.show',$bloco->id) }}">Show</a>

			@permission('bloco-edit')

			<a class="btn btn-primary" href="{{ route('bloco.edit',$bloco->id) }}">Edit</a>

			@endpermission

			@permission('bloco-delete')

			{!! Form::open(['method' => 'DELETE','route' => ['bloco.destroy', $bloco->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

        	{!! Form::close() !!}

        	@endpermission

		</td>

	</tr>

	@endforeach

	</table>

	{!! $blocos->render() !!}

@endsection