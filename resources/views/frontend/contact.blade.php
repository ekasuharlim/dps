@extends('frontend.layouts.dpsfront')
@section('content')

    <section class="background-gray-lightest">
      <div class="container">
        <div class="breadcrumbs">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contact Us</li>
          </ul>
        </div>
        <h1 class="heading">Contact Us</h1>
      </div>
    </section>
    <section>  
      <div id="contact" class="container">
        <div class="row">
          <div class="col-lg-7 col-lg-offset-1">
            <div class="row">			
                <div class="col-sm-12">			
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>				
            {!! Form::open(array('route' => 'frontend.submitcontact','method'=>'POST','files'=>true)) !!}
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Name*</label>
                    <input name="contact_name" type="text" value="{{ old('contact_name') }}" class="form-control" maxlength='200'>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Email*</label>
                    <input name="contact_email" type="text" value="{{ old('contact_email') }}" class="form-control" maxlength='200'>
                  </div>
                </div>				
                <div class="col-sm-12">
                  <div class="form-group">
                    <label valign='top'>Message*</label>
					<textarea name="message" maxlength="1000" rows="5" cols="100">{{ old('message') }}</textarea>
                  </div>
                </div>								
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
           {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>	
@endsection