<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sustainable Finance Collective Asia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->	
    <link rel="stylesheet" href="{{ URL::asset('css/dps/bootstrap.min.css') }}">
    <!-- Font Awesome and Pixeden Icon Stroke icon fonts-->
    <link rel="stylesheet" href="{{ URL::asset('css/dps/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dps/pe-icon-7-stroke.css') }}">	
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- lightbox-->
    <link rel="stylesheet" href="{{ URL::asset('css/dps/lightbox.min.css') }}" >
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ URL::asset('css/dps/style.red.css') }}" id="theme-stylesheet">
	
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ URL::asset('css/dps/custom.css') }}">
	
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <div role="navigation" class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
			  <a href="/" >
					<img src="{{ URL::asset('img/logo.png') }}" height="80"/>
			  </a>			  
          </div>
          <div id="navigation" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
              <li><a href="/about">About SFC Asia</a></li>
              <li class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle">What are we looking for? <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Sustainability themes</a></li>
                  <li><a href="#">Funding Criteria</a></li>
                  <li><a href="process.html">Assesment and funding process</a></li>
                </ul>
              </li>
              <li class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle">Proposal<b class="caret"></b></a>			  				
                <ul class="dropdown-menu">
                  <li><a href="#">Download form</a></li>
                  <li><a href="#">Submit Form</a></li>
                </ul>				
			  </li>			  
              <li>
				<a href="contact.html">Contact Us</a>
			  </li>			  
              <li><a href="contact.html">DISCLAIMER</a></li>			  			  
            </ul>
          </div>
        </div>
      </div>
    </header>
	@yield('content')
	<footer class="footer">
      <div class="footer__copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p>&copy;2016 Best company</p>
            </div>
            <div class="col-md-6">
              <p class="credit">Template by <a href="https://bootstrapious.com/free-templates" class="external">Bootstrapious.com</a></p>
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.cookie.js') }}"></script>
    <script src="{{ URL::asset('js/lightbox.min.js') }}"></script>
    <script src="{{ URL::asset('js/front.js') }}"></script>	
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>	