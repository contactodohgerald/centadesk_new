@php
	$pageTitle = 'Notifications Area';
	$notification = 'active';
@endphp
@include('layouts.head')

<body>
	<!-- Header Start -->
	@include('layouts.header')
	<!-- Header End -->

	<!-- Left Sidebar Start -->
	@include('layouts.sidebar')
	<!-- Left Sidebar End -->

	<!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">			
				<div class="row">
					<div class="col-lg-12">	
						<h2 class="st_title"><i class="uil uil-bell"></i> Notifications</h2>
					</div>					
				</div>				
				<div class="row">
					<div class="col-12">
						
						<div class="all_msg_bg" id="all_msg_bg">
														
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('layouts.footer')

	</div>
   
	<!-- Body End -->

@include('layouts.e_script')

