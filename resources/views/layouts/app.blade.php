<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Theme style -->
	<link rel="stylesheet"  href="/assets/css/admin.css">
	@yield('style')


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<!-- Main Header -->
	{{--@include('layouts.header')--}}

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Wrapper. Contains page content -->
		@yield('content')
	</div>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="/assets/js/admin.js"></script>
@yield('script')
</body>
</html>
