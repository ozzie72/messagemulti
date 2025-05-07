


<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Sistema gestión Message</title>
		
		<meta name="keywords" content="Admin Sistema Message" />
		<meta name="description" content="Message Admin - Sistema envio multicanal">
		<meta name="author" content="totaltexto">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/assets/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/assets/css">



		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/animate/animate.compat.css')}}">
		<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/all.min.css')}}" />
		{{-- <link rel="stylesheet" href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" /> --}}
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="{{asset('assets/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/jquery-ui.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/jquery-ui.theme.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/morris/morris.css')}}" />
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/skins/default.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>
		 
		{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
		@fluxAppearance
		@livewireStyles
	</head>