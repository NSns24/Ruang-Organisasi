<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<link rel="icon" href="{{ asset('assets/image/icon/logo.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/page/about-us/about.css') }}">
</head>
<body>
	<div class="logo-header">
		<a href="{{ url('/') }}"><img src="{{ asset('assets/image/icon/logo.png') }}" id="main-logo"></a>
	</div>
	<div class="title">
		<h1>ABOUT US</h1>
	</div>
	<div class="web-about">
		<div class="web-title">RuangMeeting<hr id="line1"><hr id="line2"></div>
		<div class="web-content">
			</br></br>
			Team Lebron is a team that contains 3 persons in it and are students in Bina Nusantara University. A team that run by Jacky, Novi Steven, and William Hansel just create a new website called RuangMeeting with hopefully this website can advancing Indonesia from many aspects. We called ourselves "Team Lebron" because we want to make the name simple and unique at the same time.
		</div>
	</div>
	<div class="team-about">
		<div class="img-about">
		</div>
		<div class="team-member">
			<div class="team-1">
				<img src="{{ asset('assets/image/about/doctor.svg') }}"><p>Novi Steven</p>
			</div>
			<div class="team-1">
				<img src="{{ asset('assets/image/about/detective.svg') }}"><p>Jacky</p>
			</div>
			<div class="team-1">
				<img src="{{ asset('assets/image/about/disc-jockey.svg') }}"><p>William Hansel</p>
			</div>
			<div class="desc-team">We're Binusian 20, LC01, Web Programming</div>
			<div class="credit-team">~TeamLebron~</div>
		</div>
	</div>
</body>
</html>
