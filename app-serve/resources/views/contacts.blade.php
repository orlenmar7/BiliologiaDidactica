
@extends('layouts.udema.home')

@section('content')

<section id="hero_in" class="contacts">
	<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span>Contáctanos</h1>
		</div>
	</div>
</section>
<!--/hero_in-->

<!-- <div class="contact_info">
	<div class="container">
		<ul class="clearfix">
			<li>
				<i class="pe-7s-map-marker"></i>
				<h4>Address</h4>
				<span>PO Box 97845 Baker st. 567, Los Angeles<br>California - US.</span>
			</li>
			<li>
				<i class="pe-7s-mail-open-file"></i>
				<h4>Email address</h4>
				<span>admission@udema.com - info@udema.com<br><small>Monday to Friday 9am - 7pm</small></span>

			</li>
			<li>
				<i class="pe-7s-phone"></i>
				<h4>Contacts info</h4>
				<span>+ 61 (2) 8093 3402 + 61 (2) 8093 3402<br><small>Monday to Friday 9am - 7pm</small></span>
			</li>
		</ul>
	</div>
</div> -->
<!--/contact_info-->

<div class="bg_color_1">
	<div class="container margin_120_95">
		<div class="row justify-content-between">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<h4>Envianos tu mensaje</h4>
				<contact-form></contact-form>
			</div>
			<div class="col-lg-2"></div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /bg_color_1 -->

@endsection
