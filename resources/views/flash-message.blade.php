@if ($message = Session::get('success'))
<center>
<div class="alert alert-success alert-block" style="background-color: #AEFA7D">
	<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
	<strong>Success : {{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<center>
<div class="alert alert-danger alert-block" style="background-color: #FA7D7D">
	<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
	<strong>Error : {{ $message }}</strong>
</div>
</center>
@endif


@if ($message = Session::get('warning'))
<center>
<div class="alert alert-warning alert-block" style="background-color: #FAC97D">
	<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
	<strong>Warning : {{ $message }}</strong>
</div>
</center>
@endif


@if ($message = Session::get('info'))
<center>
<div class="alert alert-info alert-block" style="background-color: #7DC1FA">
	<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
	<strong>Info : {{ $message }}</strong>
</div>
</center>
@endif


@if ($errors->any())
<center>
<div class="alert alert-danger" style="background-color: #D27DFA">
	<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
	<strong>Caution : Please check the form below for errors</strong>
</div>
</center>
@endif