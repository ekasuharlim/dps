<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('frontend.index');
	}
	
	public function about()
	{
		return view('frontend.about');
	}
	
	public function uploadEntry()
	{
		return view('frontend.uploadentry');
	}

	public function submitproposal(Request $request)
	{
		Mail::send('emails.submitproposal', ['request' => $request], function ($m) {
			$m->from('hello@app.com', 'Your Application');
			$m->to('eka.suharlim@gmail.com', 'Eka Suharlim')->subject('Your Reminder!');
		});		
		return "proposal submited" . $request->input('OrganisationName');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}
}
