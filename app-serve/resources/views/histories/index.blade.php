@extends('layouts.udema.home')

@section('content')
	<section id="hero_in" class="courses">
		<div class="wrapper">
			<div class="container">
				<h1 class="fadeInUp"><span></span>Historias Bíblicas</h1>
			</div>
		</div>
	</section>
	<!--/hero_in-->

	<div class="filters_listing sticky_horizontal">
		<div class="container">
			<!-- <ul class="clearfix">
				<li>
					<div class="switch-field">
						<input type="radio" id="all" name="listing_filter" value="all" checked>
						<label for="all">All</label>
						<input type="radio" id="popular" name="listing_filter" value="popular">
						<label for="popular">Popular</label>
						<input type="radio" id="latest" name="listing_filter" value="latest">
						<label for="latest">Latest</label>
					</div>
				</li>
				<li>
					<div class="layout_view">
						<a href="courses-grid.html"><i class="icon-th"></i></a>
						<a href="#0" class="active"><i class="icon-th-list"></i></a>
					</div>
				</li>
				<li>
					<select name="orderby" class="selectbox">
						<option value="category">Category</option>
						<option value="category 2">Literature</option>
						<option value="category 3">Architecture</option>
						<option value="category 4">Economy</option>
						</select>
				</li>
			</ul> -->
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->

	<div class="container margin_60_35">
        @foreach ($histories as $history)
            {{-- expr --}}
        <div class="box_list wow">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <figure class="block-reveal">
                        <div class="block-horizzontal"></div>
                        <a href="{{ route('histories.show', $history->id) }}">
                            <img src="{{ asset($history->image_url) }}" class="img-fluid" alt="">
                            <div class="preview"><span>Vista previa</span></div>
                        </a>
                    </figure>
                </div>
                <div class="col-lg-7">
                    <div class="wrapper">
                    <small>{{($history->category)? $history->category->name : 'Todos'}}</small>
                        <h3>{{ $history->title }}</h3>
                        <p>{{ $history->description }}</p>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> {{$history->created}}</li>

                        <li><a href="{{ route('histories.show', $history->id) }}">Jugar ahora</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach

        @empty ($histories)
            <div class="alert alert-warning" role="alert">
              No se encontraron datos en la DB
            </div>
        @endempty

        <p class="text-center add_top_60">
            @empty (!$histories)
                {{ $histories->links() }}
            @endempty
        </p>
    </div>
    <!-- /container -->
    <!-- <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-help2"></i>
                        <h4>Need Help? Contact us</h4>
                        <p>Cum appareat maiestatis interpretaris et, et sit.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-wallet"></i>
                        <h4>Payments and Refunds</h4>
                        <p>Qui ea nemore eruditi, magna prima possit eu mei.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-note2"></i>
                        <h4>Quality Standards</h4>
                        <p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>
                    </a>
                </div>
            </div>
            /row
        </div>
        /container
    </div> -->
	<!-- /bg_color_1 -->
@endsection
