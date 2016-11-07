@extends('frontend.layouts.dpsfront')
@section('content')
    <section class="background-gray-lightest">
      <div class="container">
        <div class="breadcrumbs">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Submit Proposal</li>
          </ul>
        </div>
        <h1 class="heading">Submit Proposal</h1>
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
            {!! Form::open(array('route' => 'frontend.submitproposal','method'=>'POST','files'=>true)) !!}
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Organisation Name*</label>
                    <input name="organisation_name" type="text" value="{{ old('organisation_name') }}" class="form-control" maxlength='200'>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Contact Name*</label>
                    <input name="contact_name" type="text" value="{{ old('contact_name') }}" class="form-control" maxlength='200'>
                  </div>
                </div>				
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Sustainability Theme*</label>
                    <input name="theme" type="text" value="{{ old('theme') }}" class="form-control" maxlength='300'>
                  </div>
                </div>								
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Proposal File (pdf)*</label>
                    {!! Form::file('proposal_file') !!}
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