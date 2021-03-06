@extends('app')

@section('content')

@if (Session::has('error'))
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Al parecer algo está mal.<br><br>
		{{Session::get('error')}}
	</div>
@endif


@if (Session::has('actualizado'))
	<div class="alert alert-success">
		<strong>Éxito!</strong><br><br>
		{{Session::get('actualizado')}}
	</div>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Inicio</div>

				<div class="panel-body">
					Bienvenido <b>{{Auth::user()->nombre}}</b>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
