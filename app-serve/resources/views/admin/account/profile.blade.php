@extends('layouts.dadmin.dashboard')

@section('content')


<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-lg-12">
            <!-- Panel Start -->
            <div class="panel profile-cover">
                <div class="profile-cover__img">
                    <avatars props_img="{{ asset(Auth::user()->photo_url) }}"></avatars>
                    <h3 class="h3">{{ Auth::user()->name }}</h3>
                </div>

                <div class="profile-cover__action" data-bg-img="{{ asset('assets/dadmin/assets/img/covers/01_800x150.jpg') }}" data-overlay="0.3">
                   <button style="width: 0; height: 0; opacity: 0;" class="btn btn-rounded btn-info">
                       <i class="fa fa-plus"></i>
                       <span>Follow</span>
                   </button>

                   <button style="width: 0; height: 0; opacity: 0;" class="btn btn-rounded btn-info">
                       <i class="fa fa-comment"></i>
                       <span>Message</span>
                   </button>
                </div>

                <div class="profile-cover__info">
                    <ul class="nav">
                        <li>
                            <strong>
                                <span class="label label-primary">
                                    {{Auth::user()->total_point}}
                                </span>
                            </strong>
                            Puntos
                        </li>
                        <li><strong>{{$counts['histories']}}</strong>Historias</li>
                        <li><strong>{{$counts['users']}}</strong>Usuarios</li>
                    </ul>
                </div>
                    <br>
            </div>
            <!-- Panel End -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cuenta de Usuario</h3>
                        </div>


                        {!! Form::model($user, ['route' => ['admin.account.profile.update', $user->id], 'method' => 'patch']) !!}

                            <div class="panel-content">
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
                                    <span class="label-text">Contraseña actual</span>
                                    <input type="password" name="current_password" placeholder="Contraseña actual" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}">
                                    @if ($errors->has('current_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_password') }}</strong>
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

                                <input type="submit" value="Guardar" class="btn btn-lg btn-rounded btn-success">
                                <a href="{{ route('admin.index') }}" class="btn btn-lg btn-rounded btn-outline-secondary">Cancelar</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<!-- Main Content End -->

@endsection

