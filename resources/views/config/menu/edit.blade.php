@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
		<li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item"><a href="/menu">Menu</a></li>
		<li class="breadcrumb-item active" aria-current="page">Editando Menu : {{ $menu->title }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
	<div class="col-md-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Editando Menu</h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					{!! Form::open(['url'=>['menu/update',$menu->id], 'method'=>'put']) !!}
						<div class="form-body">
							<div class="row">
								{!! Form::hidden('id_menu',$menu->id,['class'=>'form-control']) !!}
								<div class="col-md-6 form-group ">
									<label for="icono">Icono</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('icono',$menu->icon,['class'=>'form-control setIcono','id'=>'icono','readonly']) !!}

										<div class="form-control-position">
											<i class="{{$menu->icon}}" id="view-icon"></i>
										</div>
									</div>
									@error('icono')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="titulo">Titulo</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('titulo',$menu->title,['class'=>'form-control','id'=>'titulo','placeholder'=>'Titulo']) !!}
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
										{!! Form::text('url',$menu->url,['class'=>'form-control','id'=>'url','placeholder'=>'Url']) !!}
										<div class="form-control-position">
											<i class="bx bx-link-alt"></i>
										</div>
									</div>
									@error('titulo')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="descripcion">Descripción</label>
									<div class="position-relative has-icon-left">
										{!! Form::text('descripcion',$menu->description,['class'=>'form-control','id'=>'descripcion','rows'=>3,'placeholder'=>'Descripción']) !!}
										<div class="form-control-position">
											<i class="bx bx-font-family"></i>
										</div>
									</div>
									@error('descripcion')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-12 d-flex justify-content-end ">
									<button type="submit" class="btn btn-primary">Actualizar</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}	
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-outline-primary btn-lg btn-block" data-toggle="modal" data-target="#xlarge">
            Iconos
		</button>
						
        @include('admin/icons')
	</div>
</div>
@endsection

@section('js_custom')
<script src="/acciones/select_icon.js"></script>
@endsection