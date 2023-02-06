@extends('admin.index')

@section('content')
<div>
	<header style="display: flex">
		<img src="../img/logo/logo-amss.png" alt="Alcaldia de San Salvador" width=250/>     
		<h4 style="padding-top:30px; margin-left:2%;">REPORTE DE INGRESOS POR USUARIO</h4>
	</header>
	
<section id="table-success">
	<div class="card">
		<!-- datatable start -->
		<div class="table-responsive">
			<table id="table-extended-success" class="table mb-0">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Total</th>
		
			
					</tr>
				</thead>
				<tbody>
					@foreach($Marginaciones as $marginaciones)
					<tr style="height: 0px">
					
						<td>{{ $marginaciones->user }}</td>
						<td>{{ $marginaciones->total }}</td>
				
				
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- datatable ends -->
	</div>

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