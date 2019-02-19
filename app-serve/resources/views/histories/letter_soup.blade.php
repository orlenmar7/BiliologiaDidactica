@extends('layouts.udema.home')

@section('styles')
    <style type="text/css">
        #hero_in.courses:before {
          background: url({{ asset($history->image_url) }}) center center no-repeat;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
    </style>

@endsection
@section('content')


    <section id="hero_in" class="courses">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Sopa de letras {{ $history->title }}</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <!-- /section -->

                    @guest
                        {{-- expr --}}
                    @else
                        @if ($history->letter_soup)
                                <hr>
                                <section>
                                    <pay-letter-soup props_history="{{ json_encode($history) }}"></pay-letter-soup>
                                </section>
                            @endif
                    @endguest

                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">


                        @guest
                        @else
                            @if ($history->video_url)
                                <figure>
                                    <a href="{{ route('play.video', $history->id) }}" class="video"><i class="arrow_triangle-right"></i><img src="{{ asset('assets/default/vdo.png') }}" alt="" class="img-fluid"><span>Ver video</span></a>
                                </figure>
                            @endif
                            <button href="#" class="btn_1 full-width hiden"><i class="icon-download-cloud"></i> Descargar historia</button>
                        @endguest

                        <a href="{{ route('histories.index') }}" class="btn_1 full-width outline"><i class="icon_book"></i> Ver todas las historia</a>

                        <div id="list_feat">
                            <h3>Juegos</h3>
                            <ul>
                                @guest
                                    <li>
                                        <button href="#" class="btn btn-info full-width disabled" disabled>
                                            <i class="icon-lightbulb"></i>Memoria
                                        </button>
                                    </li>
                                    <li>
                                        <button href="#" class="btn btn-info full-width disabled" disabled>
                                            <i class="icon-puzzle"></i>Rompecabezas
                                        </button>
                                    </li>
                                    <li>
                                        <button href="#" class="btn btn-info full-width disabled" disabled>
                                            <i class="icon-pencil-circled"></i>Sopa de letras
                                        </button>
                                    </li>
                                @else

                                    @if ($history->letter_soup)
                                        <li>
                                            <a href="{{ route('play.letter_soup', $history->id) }}" class="btn btn-info full-width outline">
                                                <i class="icon-pencil-circled"></i>Sopa de letras
                                            </a>
                                        </li>
                                    @endif

                                    @if ($history->memores)
                                        <li>
                                            <a href="{{ route('play.memores', $history->id) }}" class="btn btn-info full-width outline">
                                                <i class="icon-lightbulb"></i>Memoria
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <a href="{{ route('play.puzzles', $history->id) }}" class="btn btn-info full-width outline">
                                            <i class="icon-puzzle"></i>Rompecabezas
                                        </a>
                                    </li>
                                @endguest

                                    <li>
                                        <a href="{{ route('histories.show', $history->id) }}" class="btn btn-info full-width outline">
                                            Historia {{ $history->title }}
                                        </a>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </aside>

            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /bg_color_1 -->
@endsection

@section('scripts')

    <script type="text/javascript">

    </script>

@endsection

