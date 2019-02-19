@extends('layouts.dadmin.auth')

@section('content')

<div class="row no-gutters">
    <div class="col-md-6">
        <!-- Login Content Start -->
        <div class="m-account--content-w" data-bg-img="{{ asset('assets/dadmin/assets/img/account/content-bg.jpg') }}">
            <div class="m-account--content">
                <h2 class="h2">¿No tienes una cuenta?</h2>
                <br><br><br>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                <a href="{{ route('register') }}" class="btn btn-rounded">Regístrate ahora</a>
            </div>
        </div>
        <!-- Login Content End -->
    </div>

    <div class="col-md-6">
        <!-- Login Form Start -->
        <div class="m-account--form-w">
            <div class="m-account--form">
                <!-- Logo Start -->
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/logo/BibliologíaDidáctica-B.svg') }}" alt="">
                    </a>
                </div>
                <!-- Logo End -->

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label class="m-account--title">Ingrese a su cuenta</label>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fas fa-user"></i>
                            </div>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" name="email" value="{{ old('email') }}"  autofocus autocomplete="off">

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

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password"  autocomplete="off">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="m-account--actions">
                        <a href="{{ route('password.request') }}" class="btn-link">
                            ¿Olvidaste tu contraseña?
                        </a>

                        <button type="submit" class="btn btn-rounded btn-info">
                            Iniciar sesión
                        </button>

                    </div>

                    <!-- <div class="m-account--alt">
                        <p><span>OR LOGIN WITH</span></p>

                        <div class="btn-list">
                            <a href="#" class="btn btn-rounded btn-warning">Facebook</a>
                            <a href="#" class="btn btn-rounded btn-warning">Google</a>
                        </div>
                    </div> -->

                    <div class="m-account--footer">
                        <p>&copy; @php
                            echo date('Y'); @endphp {{ config('app.name', 'Laravel') }}</p>
                    </div>
                </form>
            </div>
        </div>
        <!-- Login Form End -->
    </div>
</div>


@endsection
