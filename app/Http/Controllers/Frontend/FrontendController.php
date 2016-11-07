<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

use Illuminate\Http\Request;
use Mail;
use Input;
use ZipArchive;
use DateTime;
use DateTimeZone;
use File;
use Validator;

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
	
	public function themes()
	{
		return view('frontend.themes');
	}

	public function funding()
	{
		return view('frontend.funding');
	}
	
	public function process()
	{
		return view('frontend.process');
	}
	
	public function contact()
	{
		return view('frontend.contact');
	}
	
	public function disclaimer()
	{
		return view('frontend.disclaimer');
	}

	public function downloadform()
	{
		return view('frontend.downloadform');
	}
	

	public function submitProposal(Request $request)
	{
		set_time_limit(300);
		$data = array(
					'organisation_name' => Input::get('organisation_name'),
					'contact_name' => Input::get('contact_name'),
					'theme' => Input::get('theme'),
					'proposal_file' => Input::file('proposal_file'),					
				);
		$rules = array(
					'organisation_name' => 'required|max:200',
					'contact_name' => 'required|max:200',
					'theme' => 'required|max:300',
					'proposal_file' => 'file|mimes:txt'		
				);
		$validator = Validator::make($data,$rules);		
		if ($validator->fails())
		{
			return redirect()->route('frontend.uploadentry')->withErrors($validator)->withInput();
		}		
		
		
		$destFolder = env('ZIPFILE_FOLDER');
		$password = env('ZIPFILE_PASSWORD');		
		$currentDate = new DateTime('now',new DateTimeZone('Asia/Singapore'));		
		$fileExt = strtoupper(Input::file('proposal_file')->getClientOriginalExtension());
		$fileName = strtoupper(sprintf('SFC_%s_%s_FILE.%s',substr($data['organisation_name'],0,3),$currentDate->format('Ymd_His'),$fileExt));		
		$zipFilename = $destFolder.str_replace('.'.$fileExt,'.zip',$fileName);		 
		
		$sourceFileName = $destFolder.$fileName;
		if(File::exists($sourceFileName)){			
			File::delete($sourceFileName);
		}
		
		Input::file('proposal_file')->move($destFolder, $fileName); // uploading file to zip folder
				
		if(File::exists($sourceFileName)){			
			@system("zip -P $password $zipFilename $sourceFileName -q -j");
			if(File::exists($zipFilename)){			
				$emailData = array( 'filePath' => $zipFilename);		
				Mail::send('emails.submitproposal', $emailData, function ($m) use ($emailData) {
					$m->from('hello@app.com', 'Your Application');
					$m->to('eka.suharlim@gmail.com', 'Eka Suharlim')->subject('Your Reminder!');
					$m->attach($emailData['filePath']);			 
				});					
			}else{
				return 'File zip upload fails, please try again';
			}
			unlink($destFolder.$fileName);			
		}else{
			return 'File upload fails, please try again';
		}
		
		$proposal = new Proposal;
        $proposal->origanisation_name= $data['organisation_name'];
        $proposal->contact_name= $data['contact_name'];
        $proposal->theme= $data['theme'];
		$proposal->file_name= $zipFilename;
		$proposal->ip_addr= $request->ip();
        $proposal->save();
		
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
