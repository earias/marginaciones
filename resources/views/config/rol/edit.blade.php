@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
		<li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
		<li class="breadcrumb-item"><a href="/rol">Roles</a></li>
		<li class="breadcrumb-item active" aria-current="page">Editando rol: {{ $rol->titulo }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
	<div class="col-md-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Actualizar Información</h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					{!! Form::open(['url'=>['rol/update','id'=>$rol->id], 'method'=>'put']) !!}
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 form-group ">
								<label for="titulo">Título</label>
								<div class="position-relative has-icon-left">
									{!! Form::hidden('id_rol',$rol->id) !!}
									{!! Form::text('titulo',$rol->title,['class'=>'form-control','id'=>'titulo', 'placeholder' => 'Título']) !!}
									<div class="form-control-position">
										<i class="bx bx-list-ul" id="view-icon"></i>
									</div>
								</div>
								@error('titulo')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 form-group ">
								<label for="descripcion">Descripción</label>
								<div class="position-relative has-icon-left">
									{!! Form::text('descripcion',$rol->description,['class'=>'form-control','id'=>'descripcion', 'placeholder' => 'Descripción']) !!}
									<div class="form-control-position">
										<i class="bx bx-font-family" id="view-icon"></i>
									</div>
								</div>
								@error('descripcion')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<label for="roles">Permisos</label>
								{!! Form::select('permisos[]', $submenus, $lista ,['class'=>'select2 form-control','id'=>'roles', 'multiple']); !!}
							</div>
							<div class="col-md-12 form-group">
								<ul class="list-unstyled mb-0">
									<li class="d-inline-block mr-2 mb-1">
										<fieldset>
											<div class="custom-control custom-checkbox">
												{!! Form::checkbox('show', 1, true, ['class'=> 'custom-control-input bg-primary','readonly','id'=>'customColorCheck1']) !!}
												<label class="custom-control-label" for="customColorCheck1">Leer</label>
											</div>
										</fieldset>
									</li>
									<li class="d-inline-block mr-2 mb-1">
										<fieldset>
											<div class="custom-control custom-checkbox">
												{!! Form::checkbox('create', 1, $rol->create, ['class'=> 'custom-control-input bg-primary','readonly','id'=>'customColorCheck2']) !!}
												<label class="custom-control-label" for="customColorCheck2">Crear</label>
											</div>
										</fieldset>
									</li>
									<li class="d-inline-block mr-2 mb-1">
										<fieldset>
											<div class="custom-control custom-checkbox">
												{!! Form::checkbox('edit', 1, $rol->edit, ['class'=> 'custom-control-input bg-primary','readonly','id'=>'customColorCheck3']) !!}
												<label class="custom-control-label" for="customColorCheck3">Editar</label>
											</div>
										</fieldset>
									</li>
									<li class="d-inline-block mr-2 mb-1">
										<fieldset>
											<div class="custom-control custom-checkbox">
												{!! Form::checkbox('cancel', 1, $rol->cancel, ['class'=> 'custom-control-input bg-primary','readonly','id'=>'customColorCheck4']) !!}
												<label class="custom-control-label" for="customColorCheck4">Anular</label>
											</div>
										</fieldset>
									</li>
									<li class="d-inline-block mr-2 mb-1">
										<fieldset>
											<div class="custom-control custom-checkbox">
												{!! Form::checkbox('delete', 1, $rol->delete, ['class'=> 'custom-control-input bg-primary','readonly','id'=>'customColorCheck5']) !!}
												<label class="custom-control-label" for="customColorCheck5">Eliminar</label>
											</div>
										</fieldset>
									</li>
								</ul>
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
</div>
@endsection