<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Input;
use ZipArchive;
use DateTime;
use DateTimeZone;
use File;
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

	public function submitProposal(Request $request)
	{
		set_time_limit(300);
		$destFolder = env('ZIPFILE_FOLDER');
		$password = env('ZIPFILE_PASSWORD');		
		$currentDate = new DateTime('now',new DateTimeZone('Asia/Singapore'));		
		$fileExt = strtoupper(Input::file('UploadedFile')->getClientOriginalExtension());
		$fileName = strtoupper(sprintf('SFC_%s_%s_FILE.%s',substr(Input::get('OrganisationName'),0,3),$currentDate->format('Ymd_His'),$fileExt));		
		$zipFilename = $destFolder.str_replace('.'.$fileExt,'.zip',$fileName);		 
		
		$sourceFileName = $destFolder.$fileName;
		if(File::exists($sourceFileName)){			
			File::delete($sourceFileName);
		}
		
		Input::file('UploadedFile')->move($destFolder, $fileName); // uploading file to zip folder
				
		if(File::exists($sourceFileName)){			
			@system("zip -P $password $zipFilename $sourceFileName -q -j");
			if(File::exists($zipFilename)){			
				$data = array( 'filePath' => $zipFilename);		
				Mail::send('emails.submitproposal', $data, function ($m) use ($data) {
					$m->from('hello@app.com', 'Your Application');
					$m->to('eka.suharlim@gmail.com', 'Eka Suharlim')->subject('Your Reminder!');
					$m->attach($data['filePath']);			 
				});					
			}else{
				return 'File zip upload fails, please try again';
			}
			unlink($destFolder.$fileName);			
		}else{
			return 'File upload fails, please try again';
		}
		return redirect()->route('frontend.submitsuccess');
	}
	
	public function submitSuccess(){
		return view('frontend.submitsuccess');		
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}
}
