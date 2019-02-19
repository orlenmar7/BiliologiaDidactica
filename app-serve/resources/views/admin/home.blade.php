@extends('layouts.dadmin.dashboard')

@section('content')


<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Tablero {{ config('app.name', 'Laravel') }}</h3>

        <!-- <div class="dropdown">
            <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-v"></i>
            </button>


            <ul class="dropdown-menu">
                <li><a href="#"><i class="far fa-circle"></i>Panel Option 1</a></li>
                <li><a href="#"><i class="far fa-circle"></i>Panel Option 2</a></li>
                <li><a href="#"><i class="far fa-circle"></i>Panel Option 3</a></li>
            </ul>
        </div> -->
    </div>

    <section class="main--content">
        <div class="row gutter-20">
            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <div class="miniStats--header bg-darker">
                            <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#2bb3c0">5,6,9,4,9,5,3,5,9,15,3,2,2,3,9,11,9,7,20,9,7,6</p>
                        </div>

                        <div class="miniStats--body">
                            <i class="miniStats--icon fa fa-user text-blue"></i>

                            <h3 class="miniStats--title h4">Usuarios</h3>
                            <p class="miniStats--num text-blue">{{$counts['users']}}</p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <div class="miniStats--header bg-darker">
                            <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#009378">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                        </div>

                        <div class="miniStats--body">
                            <i class="miniStats--icon fa fa-rocket text-green"></i>
                            <h3 class="miniStats--title h4">Historias</h3>
                            <p class="miniStats--num text-green">{{$counts['histories']}}</p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <div class="miniStats--header bg-darker">
                            <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#e16123">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                        </div>

                        <div class="miniStats--body">
                            <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>

                            <h3 class="miniStats--title h4">Usuario con mas puntos</h3>
                            <p class="miniStats--num text-orange">{{($counts['winer']) ? $counts['winer']->name: ''}} - <span class="label label-primary">{{($counts['winer']) ? $counts['winer']->total_point: ''}} puntos</span> </p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>

        </div>
    </section>
</div>

@endsection

