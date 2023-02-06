@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/menu">Menu</a></li>
		<li class="breadcrumb-item active">Listado de submenu: {{$menu->title}}
		</li>
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
						<!-- Search Bar -->
						<div class="search-bar">
							<!-- input search -->
							{!! Form::open(['url'=>['menu/find_sub'], 'method'=>'get']) !!}
								{!! Form::hidden('id_menu', $menu->id) !!}
								<fieldset class="search-input form-group position-relative">
									{!! Form::text('search', request()->input('search'), ['class'=>'form-control rounded-right form-control-lg shadow pl-2', 'placeholder'=>'Buscar','autofocus','autocomplete'=>'off']) !!}
									<button class="btn btn-primary search-btn rounded" type="submit">
										<span class="d-none d-sm-block">Buscar</span>
										<i class="bx bx-search d-block d-sm-none"></i>
									</button>
								</fieldset>
							{!! Form::close() !!}
							<!--/ input search -->
						</div>
					</section>
				</div>
				<div class="col-md-2">
					@if(auth()->user()->rol->create)
						<button type="button" class="btn btn-outline-primary btn-lg btn-block" data-toggle="modal" data-target="#xlarge">
                            Iconos
						</button>
						
                        @include('admin/icons')
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Crear submenu</h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					{!! Form::open(['url'=>['menu/add'], 'method'=>'post']) !!}
						<div class="form-body">
							<div class="row">
								<div class="col-md-1 form-group ">
									<div class="position-relative has-icon-left">
										{!! Form::number('orden',1,['class'=>'form-control','min'=>'1']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
									@error('orden')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-3 form-group ">
									{!! Form::hidden('id_menu',$menu->id) !!}
									<div class="position-relative has-icon-left">
										{!! Form::text('icono','bx bx-list-ul',['class'=>'form-control setIcono','readonly']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
									@error('icono')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-3 form-group ">
									<div class="position-relative has-icon-left">
										{!! Form::select('tipo',[1=>'Menu Externo',2=>'Menu Interno'],1,['class'=>'form-control','id'=>'tipo']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
								</div>
								<div class="col-md-5 form-group">
									<div class="position-relative has-icon-left">
										{!! Form::text('titulo',old('titulo'),['class'=>'form-control','placeholder'=>'Titulo']) !!}
										<div class="form-control-position">
											<i class="bx bx-edit-alt"></i>
										</div>
									</div>
									@error('titulo')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<div class="position-relative has-icon-left">
										{!! Form::text('url',old('url'),['class'=>'form-control','placeholder'=>'Url']) !!}
										<div class="form-control-position">
											<i class="bx bx-link-alt"></i>
										</div>
									</div>
									@error('url')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<div class="position-relative has-icon-left">
										{!! Form::text('descripcion',old('descripcion'),['class'=>'form-control','rows'=>3,'placeholder'=>'Descripción']) !!}
										<div class="form-control-position">
											<i class="bx bx-font-family"></i>
										</div>
									</div>
									@error('descripcion')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-12 d-flex justify-content-end ">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}	
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
						<th>Icono</th>
						<th>Titulo</th>
						<th>Descripción</th>
						<th>URL</th>
						<th>estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($submenus as $sub)
					<tr style="height: 110px">
						<td class="text-bold-600 pr-0"><i class="{{ $sub->icon }}"></i></td>
						<td class="text-bold-600">{{ $sub->title }}</td>
						<td>{{ $sub->description }}</td>
						<td class="text-bold-600">{{ $sub->url }}</td>
						<td class="text-bold-600">{!! $sub->status() !!}</td>
						<td>{!! $sub->actions() !!}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- datatable ends -->
	</div>
	{{ $submenus->appends(request()->input())->links() }}
</section>
@endsection

@section('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
@endsection

@section('css_page')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
@endsection

@section('css_theme')

@endsection

@section('css_custom')
<style>
	#btn-edit{
		display:none;
	}
</style>
@endsection

@section('js_vendor')

@endsection

@section('js_page')
<script src="{{ mix('/js/page/swiper.min.js') }}"></script>
@endsection

@section('js_theme')

@endsection

@section('js_custom')
<script src="{{ mix('/js/custom/page-search.js') }}"></script>
<script src="/acciones/select_icon.js"></script>
<script src="/acciones/submenu.js"></script>
@endsection