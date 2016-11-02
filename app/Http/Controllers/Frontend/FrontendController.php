<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Input;
use ZipArchive;
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
		
		$destFolder = '\var\www\';
		$fileName = 'tstfile_'. Input::get('OrganisationName').'_test.txt';
		Input::file('FileName')->move($destFolder, $fileName); // uploading file to given path
		
		$zip = new ZipArchive();
		$zipFilename = $destFolder.'zipfile_'. Input::get('OrganisationName'). 'test.zip';		
		if ($zip->open($zipFilename, ZipArchive::CREATE)!==TRUE) {
			return("cannot open zipFilename");
		}		
		$zip->addFile($destFolder.$fileName);				
		$zip->close();
				
		$data = array( 'filePath' => $zipFilename);		
		Mail::send('emails.submitproposal', $data, function ($m) use ($data) {
			$m->from('hello@app.com', 'Your Application');
			$m->to('eka.suharlim@gmail.com', 'Eka Suharlim')->subject('Your Reminder!');
			$m->attach($data['filePath']);			 
		});		
		
		
		return 'proposal submited ' .' saved' ;
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}
}
