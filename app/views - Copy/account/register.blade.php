@extends('templates.v2')

@section('content')
<h2>Register Page</h2>
<hr>


	<!-- If there's error, show errors -->
	@include('common.errors')

	<!-- Register Field -->
	{{ Form::open(['url'=>URL::route('account-register-post'), 'method'=>'POST']) }}
	
	{{ Form::token() }}
		<table class="table">
			<tr>
				<td>{{ Form::label('username', 'Username: ') }}</td>
				<td>{{ Form::text('username', Input::old('username'), ['class'=>'form-control']) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password: ') }}</td>
				<td>{{ Form::password('password', ['class'=>'form-control'])}}</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password again: ') }}</td>
				<td>{{ Form::password('password_again', ['class'=>'form-control'])}}</td>
			</tr>
			<tr>
				<td>{{ Form::label('email', 'Email: ') }}</td>
				<td>{{ Form::email('email', Input::old('email'), ['class'=>'form-control']) }}</td>
			</tr>
			<tr>
				<td>{{ Form::hidden('e_lat', '', ['id'=>'e_lat']) }}</td>
				<td>{{ Form::hidden('e_lng', '', ['id'=>'e_lng']) }}</td>
				<td>{{ Form::submit('Register account', ['class'=>'btn btn-block btn-primary']) }}</td>
			</tr>
		</table>


		<script language="javascript" type="text/javascript">


			var e_lng = document.getElementById("e_lng");
			var e_lat = document.getElementById("e_lat");


			function getLocation() 
			{

			    if (navigator.geolocation)
			    {

			        navigator.geolocation.getCurrentPosition(setPosition);

			    } 
			    else 
			    {
			        alert("Geolocation is not supported by this browser.");
			    }

			}


			function setPosition(position)
			{
			    e_lat.value = position.coords.latitude;
			    e_lng.value = position.coords.longitude; 
			}


		</script>
		<script type="text/javascript">getLocation();</script>


	{{ Form::close() }}
<!-- Register Field Ends-->

<hr>
@stop
