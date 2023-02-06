@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item active" aria-current="page">Menu</li>
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
							{!! Form::open(['url'=>['menu/find'], 'method'=>'get']) !!}
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
<div class="content-header row">
	<div class="col-md-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Crear menu</h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					{!! Form::open(['url'=>['menu/create'], 'method'=>'post', 'id'=> 'form-action']) !!}
						<div class="form-body" id="content-form">
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="icono">Icono</label>
									<div class="position-relative has-icon-left">
										<input type="hidden" id="c-id">
										{!! Form::text('icono','bx bx-list-ul',['class'=>'form-control setIcono','id'=>'icono','readonly']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
									@error('icono')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="titulo">Título</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('titulo',null,['class'=>'form-control','id'=>'titulo','placeholder'=>'Título','required']) !!}
										<div class="form-control-position">
											<i class="bx bx-edit-alt"></i>
										</div>
									</div>
									@error('titulo')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="url">Url</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('url',null,['class'=>'form-control','id'=>'url','placeholder'=>'Url','required']) !!}
										<div class="form-control-position">
											<i class="bx bx-link-alt"></i>
										</div>
									</div>
									@error('url')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="descripcion">Descripción</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('descripcion',null,['class'=>'form-control','id'=>'descripcion','rows'=>3,'placeholder'=>'Descripción','required']) !!}
										<div class="form-control-position">
											<i class="bx bx-font-family"></i>
										</div>
									</div>
									@error('descripcion')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-12 d-flex justify-content-end ">
									<button type="submit" class="btn btn-primary" id="btn-add">Guardar</button>
									<button type="submit" class="btn btn-primary" id="btn-edit">Actualizar</button>
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
                        <th width="5%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr style="height: 110px">
						<td class="text-bold-600"><i class="{{ $menu->icon }}" id="text-icon-{{ $menu->id }}"></i></td>
						<td class="text-bold-600" id="text-title-{{ $menu->id }}">{{ $menu->title }}</td>
						<td id="text-description-{{ $menu->id }}">{{ $menu->description }}</td>
						<td class="text-bold-600" id="text-url-{{ $menu->id }}">{{ $menu->url }}</td>
						<td class="text-bold-600">{!! $menu->status() !!}</td>
						<td>{!! $menu->actions() !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- datatable ends -->
    </div>
    {{ $menus->appends(request()->input())->links() }}
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
<script src="/acciones/menu.js"></script>
@endsection