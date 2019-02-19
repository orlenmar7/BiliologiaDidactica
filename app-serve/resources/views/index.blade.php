@extends('layouts.udema.home')

@section('content')


        <section class="hero_single version_2">
            <div class="wrapper">
                <div class="container">
                    <h3>{{ config('app.name', 'Laravel') }}</h3>
                    <p>Aprende y diviértete estudiando Historias Bíblicas</p>
                    <form id="histories-search" method="GET" action="/histories/search">

                        <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" name="search" class=" search-query" placeholder="Buscar Historias Bíblicas...">
                                <input type="submit" class="btn_search" value="Buscar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /hero_single -->

        <div class="features clearfix">
            <div class="container">
                <!-- <ul>
                    <li><i class="pe-7s-study"></i>
                        <h4>+200 courses</h4><span>Explore a variety of fresh topics</span>
                    </li>
                    <li><i class="pe-7s-cup"></i>
                        <h4>Expert teachers</h4><span>Find the right instructor for you</span>
                    </li>
                    <li><i class="pe-7s-target"></i>
                        <h4>Focus on target</h4><span>Increase your personal expertise</span>
                    </li>
                </ul> -->
            </div>
        </div>
        <!-- /features -->

        <div class="container-fluid margin_120_0">
            <div class="main_title_2">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <span><em></em></span>
                        <h2>Historias Bíblicas</h2>
                        <p>Es un herramienta interactiva donde aprenderás y descubrirás las maravillosas historias de los personajes de la Biblia.</p>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div id="reccomended" class="owl-carousel owl-theme">
                @foreach ($histories as $history)
                <div class="item">
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="{{ route('histories.show', $history->id) }}">
                                <div class="preview"><span>Vista previa</span></div><img src="{{ asset($history->image_url) }}" class="img-fluid" alt=""></a>


                        </figure>
                        <div class="wrapper">
                            <small>{{($history->category)? $history->category->name : 'Todos'}}</small>
                            <h3>{{ $history->title }}</h3>
                            <p>{{ $history->description }}</p>
                            <!-- <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></div> -->
                        </div>
                        <ul>
                            <li><i class="icon_clock_alt"></i> {{$history->created}}</li>
                            <!-- <li><i class="icon_like"></i> 890</li> -->
                            <li><a href="{{ route('histories.show', $history->id) }}">Jugar ahora</a></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /carousel -->
            <div class="container">
                <p class="btn_home_align"><a href="{{ route('histories.index') }}" class="btn_1 rounded">Ver todas las historias</a></p>
            </div>
            <!-- /container -->
            <hr>
        </div>
        <!-- /container -->

        <!-- <div class="container margin_30_95">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>Categorías</h2>
                <p>Encuentra las historias bíblicas a corde a tu edad</p>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                        <a href="#0" class="grid_item">
                            <figure class="block-reveal">
                                <div class="block-horizzontal"></div>
                                <img src="{{ asset($category->image_url) }}" class="img-fluid" alt="">
                                <div class="info">
                                    <small><i class="ti-layers"></i>{{$counts[$category->id]}} historias</small>
                                    <h3>
                                        {{$category->name}}
                                    </h3>
                                </div>
                            </figure>
                        </a>
                    </div>
                @endforeach
            </div>
            /row
        </div> -->
        <!-- /container -->

        <div class="bg_color_1">
            <div class="container margin_120_95">
                <div class="main_title_2">
                    <span><em></em></span>
                    <h2>Juegos</h2>
                    <p>Encontraras juegos de memoria, sopa de letras, rompecabezas y un pequeño test.</p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <a class="box_news" href="#0">
                            <figure><img src="images/juegos/memoria.png" alt="">
                                <!-- <figcaption><strong>28</strong>Dec</figcaption> -->
                            </figure>
                            <!-- <ul>
                                <li>Mark Twain</li>
                                <li>20.11.2017</li>
                            </ul> -->
                            <h4>Memoria</h4>
                            <p>Esta sección consiste en encontrar las parejas de las imágenes de la historia bíblica previamente vista que se encuentran escondidas.</p>
                        </a>
                    </div>
                    <!-- /box_news -->
                    <div class="col-lg-6">
                        <a class="box_news" href="#0">
                            <figure><img src="images/juegos/rompe-cabezas.png" alt="">
                                <!-- <figcaption><strong>28</strong>Dec</figcaption> -->
                            </figure>
                            <!-- <ul>
                                <li>Jhon Doe</li>
                                <li>20.11.2017</li>
                            </ul> -->
                            <h4>Rompecabezas</h4>
                            <p>En este juego el objetivo es armar una determinada figura, encajando cierto número de piezas hasta lograr formar la imagen correspondiente a la historia.</p>
                        </a>
                    </div>
                    <!-- /box_news -->
                    <div class="col-lg-6">
                        <a class="box_news" href="#0">
                            <figure><img src="images/juegos/sopa-letras.png" alt="">
                                <!-- <figcaption><strong>28</strong>Dec</figcaption> -->
                            </figure>
                            <!-- <ul>
                                <li>Luca Robinson</li>
                                <li>20.11.2017</li>
                            </ul> -->
                            <h4>Sopa de letras</h4>
                            <p>Este juego trata en descubrir un número determinado de palabras ya mencionadas en la historia bíblica, enlazando estas letras en forma horizontal, vertical o diagonal, tanto de derecha a izquierda, de izquierda a derecha, así como de arriba abajo o de abajo arriba</p>
                        </a>
                    </div>
                    <!-- /box_news -->
                    <div class="col-lg-6">
                        <a class="box_news" href="#0">
                            <figure><img src="images/juegos/test.png" alt="">
                                <!-- <figcaption><strong>28</strong>Dec</figcaption> -->
                            </figure>
                            <!-- <ul>
                                <li>Paula Rodrigez</li>
                                <li>20.11.2017</li>
                            </ul> -->
                            <h4>Test</h4>
                            <p>En esta sección se presenta una serie de preguntas aleatorias, la cual consta de 5 preguntas a responder en un tiempo límite. La ponderación mínima de estas preguntas es de 80 puntos para poder superar historia.</p>
                        </a>
                    </div>
                    <!-- /box_news -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_color_1 -->

        <div class="call_section">
            <div class="container clearfix">
                <div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
                    <div class="block-reveal">
                        <div class="block-vertical"></div>
                        <div class="box_1">
                            <h3>Salmos 119:9</h3>
                            <p>¿Con qué limpiará el joven su camino? <em>Con guardar tu palabra.</em></p>
                            <!-- <a href="#0" class="btn_1 rounded">Read more</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/call_section-->

@endsection


@section('scripts')
    <script type="text/javascript">

        (function ($) {
            "use strict";

            $(window).on('load', function () {
                $('#histories-search').on('submit', function (event) {
                    event.preventDefault();
                    //console.log(window.location.href)
                    window.location = window.location.href + 'histories/search/' + $(this).find('[name="search"]').val();
                })
            });

        }(jQuery));

    </script>
@endsection
