@extends('layouts.dadmin.auth')

@section('content')

<div class="m-account">
    <div class="row no-gutters flex-row-reverse">
        <div class="col-md-6">
            <!-- Register Content Start -->
            <div class="m-account--content-w" data-bg-img="{{ asset('assets/dadmin/assets/img/account/content-bg.jpg') }}">
                <div class="m-account--content">
                    <h2 class="h2">¿Tiener una cuenta?</h2>
                    <br><br><br>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                    <a href="{{ route('login') }}" class="btn btn-rounded">Inicia sesión ahora</a>
                </div>
            </div>
            <!-- Register Content End -->
        </div>

        <div class="col-md-6">
            <!-- Register Form Start -->
            <div class="m-account--form-w">
                <div class="m-account--form">
                    <!-- Logo Start -->
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('assets/logo/BibliologíaDidáctica-B.svg') }}" alt="">
                        </a>
                    </div>
                    <!-- Logo End -->

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label class="m-account--title">Crea tu cuenta</label>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-user"></i>
                                </div>

                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre de usuario" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group" title="Fecha de nacimiento">
                                <div class="input-group-prepend">
                                    <i class="fas fa-calendar"></i>
                                </div>

                                <input id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" placeholder="Fecha de nacimiento" name="birthdate" value="{{ old('birthdate') }}">

                                @if ($errors->has('birthdate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-envelope"></i>
                                </div>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-key"></i>
                                </div>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-key"></i>
                                </div>

                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group pt-3">
                            <label class="form-check">
                                <input type="checkbox" name="checkbox" value="1" class="form-check-input">
                                <span class="form-check-label">Estoy de acuerdo con todas las declaraciones en <a href="#">términos de servicio</a></span>
                            </label>
                        </div>

                        <div class="m-account--actions">
                            <button type="submit" class="btn btn-block btn-rounded btn-info">
                                Crear cuenta
                            </button>
                        </div>

                        <div class="m-account--footer">
                            <p>&copy; @php
                            echo date('Y'); @endphp {{ config('app.name', 'Laravel') }}</p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register Form End -->
        </div>
    </div>
</div>

@endsection
