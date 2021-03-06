@extends('templates.v2')

@section('content')
<section class="page-general">
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Forgot Password Form -->
{{ Form::open(['url'=>URL::route('account-forgot-password-post'), 'method'=>'POST']) }}
	<table class="table">
		<tr>
			<td>{{ Form::label('email', 'Email: ') }}</td>
			<td>{{ Form::email('email', e(Input::old('email'))) }}</td>
		</tr>
	</table>
	{{ Form::submit('Recover') }}

{{ Form::close() }}
<hr>
</section>
@stop