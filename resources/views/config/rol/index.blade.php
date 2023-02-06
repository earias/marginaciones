@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item active" aria-current="page">Roles</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="content-body">
			<div class="row">
				<div class="col-md-10">
					<section class="search-bar-wrapper">
						<div class="search-bar">
							{!! Form::open(['url'=>['rol/find'], 'method'=>'get']) !!}
							<fieldset class="search-input form-group position-relative">
								{!! Form::text('search', request()->input('search'), ['class'=>'form-control rounded-right form-control-lg shadow pl-2', 'placeholder'=>'Buscar','autofocus','autocomplete'=>'off']) !!}
								<button class="btn btn-primary search-btn rounded" type="submit">
									<span class="d-none d-sm-block">Buscar</span>
									<i class="bx bx-search d-block d-sm-none"></i>
								</button>
							</fieldset>
							{!! Form::close() !!}
						</div>
					</section>
				</div>
				<div class="col-md-2">
					@if(auth()->user()->rol->create)
						<a href="/rol/create" class="btn btn-outline-primary btn-lg btn-block">Crear Rol</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<section id="table-success">
	<div class="card">
		<!-- datatable start -->
		<div class="table-responsive">
			<table id="table-extended-success" class="table mb-0">
				<thead>
					<tr>
						<th colspan="1"></th>
						<th colspan="5" class="permisos">Permisos</th>
						<th colspan="2"></th>
					</tr>
					<tr>
						<th>Titulo</th>
						<th class="permisos">Leer</th>
						<th class="permisos">Crear</th>
						<th class="permisos">Modificar</th>
						<th class="permisos">Anular</th>
						<th class="permisos">Eliminar</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $rol)
					<tr style="height: 110px">
						<td>
							<p class="text-bold-600">{{ $rol->title }}: <span style="font-weight: normal;">{{ $rol->description }}</span></p>
							
						</td>
						<td class="text-bold-600 permisos">
							<fieldset>
								<div class="checkbox">
									{!! Form::checkbox('name', 'value', $rol->show, ['class'=> 'checkbox-input','readonly']) !!}
									<label class="custom-control-label" for="customColorCheck1"></label>
								</div>
							</fieldset>
						</td>
						<td class="text-bold-600 permisos">
							<fieldset>
								<div class="checkbox">
									{!! Form::checkbox('name', 'value', $rol->create, ['class'=> 'checkbox-input','readonly']) !!}
									<label class="custom-control-label" for="customColorCheck1"></label>
								</div>
							</fieldset>
						</td>
						<td class="text-bold-600 permisos">
							<fieldset>
								<div class="checkbox">
									{!! Form::checkbox('name', 'value', $rol->edit, ['class'=> 'checkbox-input','readonly']) !!}
									<label class="custom-control-label" for="customColorCheck1"></label>
								</div>
							</fieldset>
						</td>
						<td class="text-bold-600 permisos">
							<fieldset>
								<div class="checkbox">
									{!! Form::checkbox('name', 'value', $rol->cancel, ['class'=> 'checkbox-input','readonly']) !!}
									<label class="custom-control-label" for="customColorCheck1"></label>
								</div>
							</fieldset>
						</td>
						<td class="text-bold-600 permisos">
							<fieldset>
								<div class="checkbox">
									{!! Form::checkbox('name', 'value', $rol->delete, ['class'=> 'checkbox-input','readonly']) !!}
									<label class="custom-control-label" for="customColorCheck1"></label>
								</div>
							</fieldset>
						</td>
						<td class="text-bold-600">{!! $rol->estado() !!}</td>
						<td>{!! $rol->acciones() !!}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- datatable ends -->
	</div>
	{{ $roles->appends(request()->input())->links() }}
</section>
@endsection

@section('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
@endsection

@section('css_page')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
@endsection

@section('css_custom')
<style>
	.permisos{
		background: #F2F4F4;
	}
</style>
@endsection

@section('js_page')
<script src="{{ mix('/js/page/swiper.min.js') }}"></script>
@endsection

@section('js_custom')
<script src="{{ mix('/js/custom/page-search.js') }}"></script>
<script src="/acciones/rol.js"></script>
@endsection