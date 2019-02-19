
@extends('layouts.udema.home')

@section('content')
<section id="hero_in" class="general">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Acerca {{ config('app.name', 'Laravel') }}</h1>
        </div>
    </div>
</section>
<!--/hero_in-->


<div class="bg_color_1">
    <div class="container margin_120_95">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>{{ config('app.name', 'Laravel') }}</h2>
            <p>Aprende y diviértete estudiando Historias Bíblicas</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-6 wow" data-wow-offset="150">
                <figure class="block-reveal">
                    <div class="block-horizzontal"></div>
                    <img src="{{ asset('images/nuevas/bg.jpg') }}" class="img-fluid" alt="">
                </figure>
            </div>
            <div class="col-lg-5">
                <p>Es una herramienta cuyo objetivo es enseñar las Historias de la Biblia a través de videos y textos, presentado así un contenido más fácil de digerir y entretenido. De igual manera cuenta con diferentes formas de ejercitar lo aprendido y esto es a través de juegos de memoria, sopa de letras, rompecabezas y un pequeño test que consta de cinco preguntas relacionada con la lección enseñada.</p>
                <hr>
                <p><b>Misión:</b> inculcar valores y principios a través de las enseñanzas bíblicas, fomentando así las buenas costumbres y ser una herramienta que sume a la sociedad.</p>

                <hr>
                <p><b>Visión:</b> Generar un impacto positivo en la sociedad.</p>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--/container-->
</div>
<!--/bg_color_1-->

@endsection
