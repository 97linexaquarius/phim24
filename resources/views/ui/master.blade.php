<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- CSS reset -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- Resource style -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/modernizr.js"></script>
	<script src="//content.jwplatform.com/libraries/Xp8iNyDU.js"></script>
	<!-- Modernizr -->
	<title>Phim</title>
</head>

<body ng-app="ui-app">
<div ng-controller="MenuController">
	<header class="cd-main-header">
		<a class="cd-logo" href="#0"><img src="images/logo.png" alt="Logo"></a>
		<ul class="cd-header-buttons">
			<li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
			<li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
		</ul>
		<!-- cd-header-buttons -->
	</header>
	<nav class="cd-nav">
		<ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
			<li class="has-children">
				<a href="">PHIM LẺ</a>
				<ul class="cd-nav-icons is-hidden">
					<li class="go-back"><a href="#0">Menu</a></li>
					<li ng-repeat="l in lcpl">
						<a class="cd-nav-item" href="">
							<h3>@{{l.name}}</h3>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-children">
				<a href="">PHIM BỘ</a>
				<ul class="cd-nav-icons is-hidden">
					<li class="go-back"><a href="#0">Menu</a></li>			
					<li ng-repeat="l in lcpb">
						<a class="cd-nav-item" href="">
							<h3>@{{l.name}}</h3>
						</a>
					</li>
				</ul>
			</li>
			<li><a href="">PHIM CHIẾU RẠP</a></li>
			<li><a href="">PHIM MỚI</a></li>
		</ul>
		<!-- primary-nav -->
	</nav>
	<!-- cd-nav -->
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Nhập tên phim bạn muốn tìm kiếm...">
		</form>
	</div>
</div>
	<main class="cd-main-content">
		@yield('content')
	</main>

	<script src="js/jquery-2.1.1.js"></script>
	<script	src="angular/angular.min.js"></script>
	<script	src="angular/ui.min.js"></script>
	<script src="js/jquery.allofthelights.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.mobile.custom.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/owl.js"></script>
</body>

</html>