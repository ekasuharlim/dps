@extends('frontend.layouts.dpsfront')
@section('content')
    <section>  
      <div id="contact" class="container">
        <div class="row">
          <div class="col-lg-7 col-lg-offset-1">
            <h4 class="heading margin-bottom">Submit Proposal</h4>
            {!! Form::open(array('route' => 'frontend.submitproposal','method'=>'POST')) !!}
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Organisation Name</label>
                    <input name="OrganisationName" type="text" value="test" class="form-control">
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