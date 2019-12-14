<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Canteen Food System Redemption Notification</title>
	</head>
	<body>
		<h1><img src="{{ asset('images/logo.jfif') }}" width="30" height="20">Canteen Food System</h1>
		<br>
		<p><b>Dear Mr./Mrs. {{ $parentdet->username }}</b></p>
		<h3>Todays Orders Redeemed </h3>
		<br>

		<p><b>Orders Details:</b></p>
		<p>
			<table border="1">
				<thead>
					<th>Student ID</th>
					<th>Child Name</th>
					<th>Menu Item</th>
					<th>Menu Qty</th>
					<th>Time Redeemed</th>
				</thead>
				@foreach($redeemdetails as $r)
					<tr>
						<td>{{ strtoupper($r->studentid) }}</td>
						<td>{{ ucfirst($r->studentname) }}</td>
						<td>{{ ucfirst($r->menuname) }}</td>
						<td><center>{{ $r->menuqty }}</center></td>
						<td>{{ date_format(date_create($r->redeemdate), 'h:i:s a d/m/Y') }}</td>
					</tr>
				@endforeach
			</table>
		</p>
		<br>
	 	<p><b>Thank you.</b></p>
	</body>
</html> 