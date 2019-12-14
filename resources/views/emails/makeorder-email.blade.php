<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Canteen Food System Order Reminder</title>
	</head>
	<body>
		<h1><img src="{{ asset('images/logo.jfif') }}" width="30" height="20">Canteen Food System</h1>
		<br>
		<p><b>Dear Mr./Mrs. {{ $parentdet->username }}</b></p>
		<br>

		<p>
			This is a reminder on making meal orders for our <a href="https://localhost/cfsv1/public/">Canteen Food System</a>. Please make sure you have submitted your children's meal orders for next week of school session. Kindly make meal orders on weekends only as orders that are made not on weekends will not be processed by our canteen provider. Do note that our menus will be updated by every Friday (excluding school holidays).
		</p>
		<h2>
			<center><b><a href="https://localhost/cfsv1/public/user/menuselect">Make Orders Now</a></b></center>
		</h2>
		<br>
	 	<p><b>Thank you.</b></p>
	</body>
</html> 