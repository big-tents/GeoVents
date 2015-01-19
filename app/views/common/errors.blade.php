@if($errors->has())
	<ul class="errors">
		<!-- {{ $errors->first('username', '<li>:message</li>') }} -->
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@endif
