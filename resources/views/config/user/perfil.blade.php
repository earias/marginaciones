@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Library</a></li>
        <li class="breadcrumb-item"><a href="#">Data</a></li> -->
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
    </ol>
</nav>
@endsection

@section('content')

<section class="users-edit">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Cuenta</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <!-- users edit media object start -->
                        <div class="media mb-2">
                            <a class="mr-2" href="#">
                                <img src="/img/avatar/{{ auth()->user()->avatar }}" alt="users avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>

                            <div class="media-body">
                                <h4 class="media-heading">Avatar</h4>
                                <div class="col-12 px-0 d-flex">
                                    <a href="#" data-toggle="modal" data-target="#default" class="btn btn-sm btn-primary mr-25">Cambiar</a>
                                </div>
                                <!--Basic Modal -->
                                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            {!! Form::open(['url'=>['update_avatar','user'=>auth()->user()->id], 'method'=>'put', 'files'=>'true']) !!}


                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel1">Seleccionar foto de perfil</h3>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="custom-file">
                                                    <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01" >
                                                    <label class="custom-file-label" for="inputGroupFile01">user.jpg</label>
                                                    @error('avatar')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cambiar</span>
                                                </button>
                                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancelar</span>
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- users edit media object ends -->
                        <!-- users edit account form start -->
                        {!! Form::open(['url'=>['update_perfil','user'=>auth()->user()->id], 'method'=>'put']) !!}
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Nombre completo</label>
                                        {!! Form::text('nombre',auth()->user()->name,['class'=>'form-control','placeholder'=>'Nombre completo','required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Rol principal</label>
                                        <input type="text" class="form-control" readonly value="{{ auth()->user()->rol->title }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Estado</label>
                                        <input type="text" class="form-control" readonly value="@if(auth()->user()->status == 1) Activo @else Inactivo @endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Estilo de la plantilla</label>
                                        {!! Form::select('style',$styles,auth()->user()->id_style,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Color del menu</label>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($styles_menu as $menu)
                                        <li class="d-inline-block mr-2 mb-1">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" value="{{$menu->id_style_menu}}" class="custom-control-input bg-{{$menu->sub}}" name="color" id="customColorRadio{{$menu->id_style_menu}}" @if(auth()->user()->id_style_menu == $menu->id_style_menu) checked @endif>
                                                    <label class="custom-control-label" for="customColorRadio{{$menu->id_style_menu}}">{{$menu->title}}</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-1">
                                        <thead>
                                            <tr>
                                                <th>Roles</th>
                                                <th>Leer</th>
                                                <th>Crear</th>
                                                <th>Modificar</th>
                                                <th>Anular</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(auth()->user()->roles as $role)
                                            <tr>
                                                <td>{{ $role->rol->title }}</td>
                                                <td>
                                                    <div class="checkbox">
                                                        {!! Form::checkbox('name', 'value', $role->rol->show, ['class'=> 'checkbox-input','readonly']) !!}
                                                        <label for="users-checkbox1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        {!! Form::checkbox('name', 'value', $role->rol->create, ['class'=> 'checkbox-input','readonly']) !!}
                                                        <label for="users-checkbox2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        {!! Form::checkbox('name', 'value', $role->rol->edit, ['class'=> 'checkbox-input','readonly']) !!}
                                                        <label for="users-checkbox3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        {!! Form::checkbox('name', 'value', $role->rol->cancel, ['class'=> 'checkbox-input','readonly']) !!}
                                                        <label for="users-checkbox4"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        {!! Form::checkbox('name', 'value', $role->rol->delete, ['class'=> 'checkbox-input','readonly']) !!}
                                                        <label for="users-checkbox4"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Guardar cambios</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <hr>
                        {!! Form::open(['url'=>['update_pass'], 'method'=>'put']) !!}
                        <div class="row">

                            <div class="col-12 col-sm-12">
                                <h5 class="mb-1"><i class="bx bx-info-circle mr-25"></i>Cambiar contraseña</h5>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Contraseña actual</label>
                                    <input class="form-control" name="present_password" type="password" value="{{old('present_password')}}" required>
                                </div>
                                @error('present_password')
                                <code>{{ $errors->first('present_password') }}</code>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                <div class="form-group">
                                    <label>Nueva contraseña</label>
                                    <input class="form-control" name="password" type="password" value="{{old('password')}}" required>
                                </div>
                                @error('password')
                                <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                <div class="form-group">
                                    <label>Confirmar contraseña</label>
                                    <input class="form-control" name="password_confirmation" type="password" value="{{old('password_confirmation')}}" required>
                                </div>
                                @error('password_confirmation')
                                <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Cambiar contraseña</button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                        <!-- users edit account form ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection