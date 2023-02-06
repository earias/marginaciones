@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item active" aria-current="page">Periodo</li>
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
							{!! Form::open(['url'=>['periodo/find'], 'method'=>'get']) !!}
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
						<a href="/usuario/create" class="btn btn-outline-primary btn-lg btn-block">Crear Usuario</a>
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
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($periodos as $periodo)
					<tr style="height: 0px">
													
                        <td class="text-bold-600">{{ $loop->iteration() }}</td>
						<td class="text-bold-600">{{ $periodo->name }}</td>
						<td class="text-bold-600">{{ $periodo->description }}</td>
						<td class="text-bold-600">{!! $periodo->status() !!}</td>
						<td>{!! $periodo->actions() !!}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- datatable ends -->
	</div>
	{{ $periodos->appends(request()->input())->links() }}
</section>
@endsection
@section('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
@endsection

@section('css_page')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
@endsection

@section('js_page')
<script src="{{ mix('/js/page/swiper.min.js') }}"></script>
@endsection

@section('js_custom')
<script src="{{ mix('/js/custom/page-search.js') }}"></script>
<script src="/acciones/user.js"></script>
@endsection