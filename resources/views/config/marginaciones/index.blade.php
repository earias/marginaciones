@extends('admin.index')

@section('content')
<div>
	<header style="display: flex">
		<img src="../img/logo/logo-amss.png" alt="Alcaldia de San Salvador" width=250/>     
		<h4 style="padding-top:30px; margin-left:2%;">REGISTRO DE MARGINACIÓN <a href="/marginaciones" class="btn btn-primary btn-sm float-end">Ver todos </a></h4>
	</header>

<div class="row" style="padding-top: 10px; margin:0 auto;">
	<div class="col-12 col-sm-12">
		<div class="content-body">
			<div class="row">
				<div class="col-md-10">
					<section class="search-bar-wrapper">
						<div class="search-bar">
							{!! Form::open(['url'=>['marginaciones/find'], 'method'=>'get']) !!}
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
			
						<th>ID</th>
						<th>Libro</th>
						<th>Partida</th>
						<th>Folio</th>
						<th>Año</th>
						<th>Tipo</th>
						<th>Texto</th>
						<th>Libro M</th>
						<th>Marginacion</th>
						<th>Inhabilitado</th>
						<th>Texto</th>
						<th>Iniciales</th>
						<th>Jefe</th>
						<th>Usuario</th>
						<th>fecha</th>
					
					</tr>
				</thead>
				<tbody>
					@foreach($Marginaciones as $marginaciones)
					<tr style="height: 0px">
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->id }}</td>
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->libro }}</td>
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->partida }}</td>
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->folio}}</td>
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->annio }}</td>
						<td style="white-space: nowrap; max-width:20px">{{ $marginaciones->tipo }}</td>
						<td style="white-space: nowrap; overflow: hidden; text-overflow:ellipsis; max-width:100px">{{ $marginaciones->texto }}</td>
						<td style="white-space: nowrap;">{{ $marginaciones->libromarg}}</td>
						<td>{{ $marginaciones->marginacion }}</td>
						<td>{{ $marginaciones->habilitado }}</td>
						<td  style="white-space: nowrap;
						overflow: hidden; text-overflow:ellipsis;  max-width:100px">{{ $marginaciones->textoh }}</td>
						<td>{{ $marginaciones->iniciales}}</td>
						<td style="white-space: nowrap;
						overflow: hidden; text-overflow:ellipsis;  max-width:100px">{{ $marginaciones->jefe }}</td>
						<td>{{ $marginaciones->user }}</td>
						<td>{{ $marginaciones->created_at}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- datatable ends -->
	</div>
	{{ $Marginaciones->appends(request()->input())->links() }}
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

<style>
	.croptext{
        white-space: 'nowrap';
        overflow: "hidden";
        text-overflow:"ellipsis";        
        max-width:"30px";
	}
</style>