@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/menu">Menu</a></li>
		<li class="breadcrumb-item">
			<a href="/menu/add/{{ $submenu->id_menu }}">Listado de submenu: {{$submenu->menu->title}}</a>
		</li>
		<li class="breadcrumb-item active">
			Editando submenu: {{$submenu->title}}
		</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
	<div class="col-md-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Editando submenu</h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					{!! Form::open(['url'=>['menu/edit_sub','id'=>$submenu->id], 'method'=>'post']) !!}
						<div class="form-body">
							<div class="row">
								<div class="col-md-1 form-group ">
									<div class="position-relative has-icon-left">
										{!! Form::number('orden',$submenu->order,['class'=>'form-control','min'=>'1']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
									@error('orden')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-3 form-group ">
									{!! Form::hidden('id_menu',$submenu->id_menu) !!}
									{!! Form::hidden('id_submenu',$submenu->id) !!}
									<div class="position-relative has-icon-left">
										{!! Form::text('icono',$submenu->icon,['class'=>'form-control setIcono','readonly']) !!}
										<div class="form-control-position">
											<i class="{{$submenu->icon}}" id="view-icon"></i>
										</div>
									</div>
									@error('icono')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-3 form-group ">
									<div class="position-relative has-icon-left">
										{!! Form::select('tipo',[1=>'Menu Externo',2=>'Menu Interno'],$submenu->tipo,['class'=>'form-control','id'=>'tipo']) !!}
										<div class="form-control-position">
											<i class="bx bx-list-ul" id="view-icon"></i>
										</div>
									</div>
								</div>
								<div class="col-md-5 form-group">
									<div class="position-relative has-icon-left">
										{!! Form::text('titulo',$submenu->title,['class'=>'form-control','placeholder'=>'Titulo']) !!}
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
										{!! Form::text('url',$submenu->url,['class'=>'form-control','placeholder'=>'Url']) !!}
										<div class="form-control-position">
											<i class="bx bx-link-alt"></i>
										</div>
									</div>
									@error('titulo')
                                       <p class="text-danger">{{ $message }}</p>
                                    @enderror
								</div>
								<div class="col-md-6 form-group">
									<div class="position-relative has-icon-left">
										{!! Form::text('descripcion',$submenu->description,['class'=>'form-control','rows'=>3,'placeholder'=>'Descripción']) !!}
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
@include('admin/icons')
@endsection

@section('js_custom')
<script src="/acciones/select_icon.js"></script>
@endsection