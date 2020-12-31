@extends('layouts.app')

@section('content')
<div class="container">
	@foreach($data as $key => $value)
	<div class="col-sm-12">
      	<a href="{!! $value->url !!}">
      		<h3 class="title">{!! $value->title !!}</h3>
      	</a>
      	<p class="text-muted">
	      	<strong>Points :</strong> {!! $value->points !!}
	      	<strong>Comments :</strong> {!! $value->comments !!}
      	</p>
      	<p class="text-muted">Posted by <a href="#">{!! $value->username !!}</a></p>
    </div>
    @endforeach
</div>
@endsection