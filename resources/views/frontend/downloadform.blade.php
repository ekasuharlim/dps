@extends('frontend.layouts.dpsfront')
@section('content')

    <section class="background-gray-lightest">
      <div class="container">
        <div class="breadcrumbs">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Download Form</li>
          </ul>
        </div>
        <h1 class="heading">Download Form</h1>
      </div>
    </section>
    <section class="blog-post">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="post-content">
			  <p>You can download the form by clicking this <a href="/download/formsample.txt">link</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection