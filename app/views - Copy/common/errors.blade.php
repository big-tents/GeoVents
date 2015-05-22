@if($errors->has())
	<div class="alert alert-danger" role="alert">
		<!-- {{ $errors->first('username', '<li>:message</li>') }} -->
		@foreach($errors->all() as $error)
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
  			{{ $error }}
  			<br/>
		@endforeach
	</div>
@endif
