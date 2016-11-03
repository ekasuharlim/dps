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
		
		$destFolder = env('ZIPFILE_FOLDER');
		$password = env('ZIPFILE_PASSWORD');
		$fileName = 'tstfile_'. Input::get('OrganisationName').'_test.txt';
		Input::file('FileName')->move($destFolder, $fileName); // uploading file to given path
		
		$sourceFileName = $destFolder.$fileName;
		$zipFilename = $destFolder.'zipfile_'. Input::get('OrganisationName'). 'test.zip';		
		
		@system("zip -P $password $zipFilename $sourceFileName -q -j");
		// $zip = new ZipArchive();
		// if ($zip->open($zipFilename, ZipArchive::CREATE)!==TRUE) {
			// return("cannot open zipFilename");
		// }				
		// $zip->setPassword(env('ZIPFILE_PASSWORD'));
		// $zip->addFile($destFolder.$fileName,$fileName);				
		// $zip->close();
				
		$data = array( 'filePath' => $zipFilename);		
		Mail::send('emails.submitproposal', $data, function ($m) use ($data) {
			$m->from('hello@app.com', 'Your Application');
			$m->to('eka.suharlim@gmail.com', 'Eka Suharlim')->subject('Your Reminder!');
			$m->attach($data['filePath']);			 
		});		
		
		unlink($destFolder.$fileName);
		
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
