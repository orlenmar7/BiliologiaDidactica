<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-outlines">
<head>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ==== Document Title ==== -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('assets/udema/html_menu_2/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('assets/udema/html_menu_2/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('assets/udema/html_menu_2/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('assets/udema/html_menu_2/img/apple-touch-icon-144x144-precomposed.png') }}">


    <!-- BASE CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/udema/html_menu_2/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/udema/html_menu_2/css/vendors.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/udema/html_menu_2/css/icon_fonts/css/all_icons.min.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/udema/html_menu_2/css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"/>


    <link rel="stylesheet" href="{{asset('plugins/Trumbowyg/ui/trumbowyg.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/wordfind/style.css') }}">

    @yield('styles')

</head>

<body>

	<div id="app">
		<div id="preloader">
			<div data-loader="circle-side"></div>
		</div>
		<!-- End Preload -->

		<header class="header fadeInDown">
			<div id="logo">
				<a href="{{ route('index') }}"><img src="{{ asset('assets/logo/BibliologíaDidáctica-B.svg') }}" width="149" height="42" data-retina="true" alt=""></a>
			</div>
			<ul id="top_menu">

                <li><a href="{{ route('index') }}">Inicio</a></li>
                <li><a href="{{ route('about') }}">Acerca</a></li>
                <li><a href="{{ route('histories.index') }}">Historias Bíblicas</a></li>
                <li><a href="{{ route('contacts') }}">Contáctanos</a></li>

				@guest
					<li><a href="{{ route('login') }}" class="login">Ingresar</a></li>
					<!-- <li><a href="#0" class="search-overlay-menu-btn">Search</a></li> -->
					<!-- <li class="hidden_tablet"><a href="#0">Buy this template</a></li> -->
					<li class="hidden_tablet">
						<a href="{{ route('register') }}" class="btn_1 rounded">Crear cuenta</a>
					</li>
				@else
					<li class="nav-item dropdown nav--user online">
	                    <a href="#" class="nav-link" data-toggle="dropdown">
	                        <img style="width: 40px;" src="{{ asset(Auth::user()->photo_url) }}" alt="" class="rounded-circle">
	                        <span>{{ Auth::user()->name }} <span class="caret"></span></span>
	                        <i class="fa fa-angle-down"></i>
	                    </a>

	                    <ul class="dropdown-menu">
	                        <li><a href="{{ Auth::user()->isAdmin() ? route('admin.account.profile') : route('dashboard.account.profile') }}"><i class="far fa-user"></i>Mi Perfil</a></li>
                            @if (Auth::user()->isAdmin())
	                           <li>
                                    <a href="{{ route('admin.index') }}"><i class="fa fa-cog"></i>Tablero</a>
                                </li>
                            @endif
	                        <li class="dropdown-divider"></li>
	                        <li>
	                            <a href="{{ route('logout') }}"
	                            onclick="event.preventDefault();
	                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Cerrar Sesión</a>
		                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                        @csrf
	                            </form>
	                        </li>
	                    </ul>
	                </li>
                @endguest

				<!-- s<li>
					<div class="hamburger hamburger--spin">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
				</li> -->
			</ul>
			<!-- /top_menu -->
		</header>
		<!-- /header -->

		<main>
			@yield('content')
		</main>
		<!-- /main -->

		<footer>
			<div class="container margin_120_95">
				<div class="row">
					<div class="col-lg-5 col-md-12 p-r-5">
						<p><img src="{{ asset('assets/logo/BibliologíaDidáctica-B.svg') }}" width="149" height="42" data-retina="true" alt=""></p>
						<p style="font-size: 18px;">Es una herramienta cuyo objetivo es enseñar las Historias de la Biblia a través de videos y textos, presentado así un contenido más fácil de digerir y entretenido.</p>
						<div class="follow_us">
							<ul>
								<li>Siguenos</li>
								<li><a href="#0"><i class="ti-facebook"></i></a></li>
								<li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
								<li><a href="#0"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 ml-lg-auto">
						<h5>Links</h5>
						<ul class="links">
                            <li><a href="{{ route('index') }}">Inicio</a></li>
							<li><a href="{{ route('about') }}">Acerca</a></li>
                            <li><a href="{{ route('histories.index') }}">Historias Bíblicas</a></li>
                            <li><a href="{{ route('contacts') }}">Contáctanos</a></li>
							<li><a href="{{ route('login') }}">Ingresar</a></li>
							<li><a href="{{ route('register') }}">Crear Cuenta</a></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6">
						<h5>Contactos</h5>
						<ul class="contacts">
							<li><a href="tel://85280932400"><i class="ti-mobile"></i> + 58 23 8093 3400</a></li>
							<li><a href="mailto:info@bibliologiadidactica.com"><i class="ti-email"></i> info@bibliologiadidactica.com</a></li>
						</ul>
						<div id="newsletter">
						<h6 class="hidden">Suscribete</h6>
						<div id="message-newsletter"></div>
						<form method="post" action="assets/newsletter.php" class="hidden" name="newsletter_form" id="newsletter_form">
							<div class="form-group">
								<input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Ingresar tu email">
								<input type="submit" value="Enviar" id="submit-newsletter">
							</div>
						</form>
						</div>
					</div>
				</div>
				<!--/row-->
				<hr>
				<div class="row">
					<div class="col-md-8">
						<ul id="additional_links">
							<li><a href="#0">Terminos y condiciones</a></li>
							<li><a href="#0">Política de privacidad</a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<div id="copy">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}</div>
					</div>
				</div>
			</div>
		</footer>
		<!--/footer-->

		<!-- Search Menu -->
		<div class="search-overlay-menu">
			<span class="search-overlay-close"><span class="closebt"><i class="ti-close"></i></span></span>
			<form role="search" id="searchform" method="get">
				<input value="" name="q" type="search" placeholder="Search..." />
				<button type="submit"><i class="icon_search"></i>
				</button>
			</form>
		</div><!-- End Search Menu -->

	</div>


	<!-- COMMON SCRIPTS -->
    <script src="{{ asset('assets/udema/html_menu_2/js/jquery-2.2.4.min.js') }}"></script>

    <script src="{{ asset('assets/udema/html_menu_2/js/common_scripts.js') }}"></script>
    <script src="{{ asset('assets/udema/html_menu_2/js/main.js') }}"></script>

    <script src="{{asset('plugins/wordfind/wordfind.js') }}"></script>
    <script src="{{asset('plugins/wordfind/wordfindgame.js') }}"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- notificacione swal --}}
    @include('sweetalert::alert')

	@yield('scripts')



</body>
</html>
