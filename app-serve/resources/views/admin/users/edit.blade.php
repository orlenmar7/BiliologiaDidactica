@extends('layouts.dadmin.dashboard')

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Editar usuario</h3>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-list"></i> Usuarios</a>
            </div>

            <div class="panel-content">
                {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Estado') !!}
                        {!! Form::select('status', ['' => 'Seleccione', 'active' => 'Activo', 'deactivated' => 'Desactivo'], null, ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control']) !!}

                        @if ($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre de usuario') !!}
                        {!! Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nombre de usuario']) !!}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        {!! Form::label('birthdate', 'Fecha de nacimiento') !!}
                        {!! Form::date('birthdate', old('birthdate'), ['class' => $errors->has('birthdate') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Fecha de nacimiento']) !!}

                        @if ($errors->has('birthdate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', old('email'), ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Email']) !!}

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <span class="label-text">Contraseña</span>
                        <input type="password" name="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <span class="label-text">Confirmar contraseña</span>
                        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-lg btn-success">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
