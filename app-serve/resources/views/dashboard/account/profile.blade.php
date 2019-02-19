
@extends('layouts.udema.home')

@section('content')
<section id="hero_in" class="general">
    <div class="wrapper">
        <div class="container">
            <div class="profile-cover__img">
                <avatars props_img="{{ asset(Auth::user()->photo_url)}}"></avatars>
            </div>
            <h1 class="fadeInUp"><span></span>
                {{ Auth::user()->name }}
            </h1>
            <h4>
                <span class="label label-primary">
                    Puntos: {{Auth::user()->total_point}}
                </span>
            </h4>
        </div>
    </div>
</section>
<!--/hero_in-->


<div class="bg_color_1">
    <div class="container margin_120_95">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>Cuenta de Usuario</h2>
            <p><b>Categoría:</b> {{$user->my_category}}</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 wow" data-wow-offset="150">
                {!! Form::model($user, ['route' => ['dashboard.account.profile.update', $user->id], 'method' => 'patch']) !!}

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
                    <a href="{{ route('index') }}" class="btn btn-lg btn-rounded btn-outline-secondary">Cancelar</a>

                {!! Form::close() !!}
            </div>
            <div class="col-lg-3"></div>
        </div>
        <!--/row-->
    </div>
    <!--/container-->
</div>
<!--/bg_color_1-->

@endsection
