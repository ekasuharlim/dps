@extends('frontend.layouts.dpsfront')
@section('content')
	<style>
		.main-jumbotron {	
			background: url('{{ URL::asset('img/jumbotron1.jpg') }}') center center no-repeat;	
		}
	</style>
    <div class="jumbotron main-jumbotron" >
      <div class="container">
        <div class="content">
          <h1>SFC Asia</h1>
          <p class="margin-bottom">Some Description</p>
          <p><a class="btn btn-white" href="/about">Learn more</a></p>
        </div>
      </div>
    </div>
@endsection