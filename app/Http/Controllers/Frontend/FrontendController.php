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
use Log;

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
		Log::info('Submit Proposal Start');
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
					'proposal_file' => 'file|mimes:pdf'		
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
		$fileName = strtoupper(sprintf('SFC_%s_%s_FILE_%s',
											substr($data['organisation_name'],0,3),
											$currentDate->format('Ymd_His'),
											substr(Input::file('proposal_file')->getClientOriginalName(),0,20)));		
		$fileName = str_replace(' ','_',$fileName);
		$zipFilename = $destFolder.str_replace('.'.$fileExt,'.zip',$fileName);		 
		
		$sourceFileName = $destFolder.$fileName;
		if(File::exists($sourceFileName)){			
			File::delete($sourceFileName);
		}
		Log::info('Moving file');		
		Input::file('proposal_file')->move($destFolder, $fileName); // uploading file to zip folder
		Log::info('Zipping file');		
		if(File::exists($sourceFileName)){			
			@system("zip -P $password $zipFilename $sourceFileName -q -j");
			if(File::exists($zipFilename)){			
				$emailData = array( 'filePath' => $zipFilename, 
									'emailFrom' => env('MAIL_FROM_ADDR'),
									'emailTo' => env('MAIL_TO_ADDR'),									
									'organisation_name' => Input::get('organisation_name'),
									'contact_name' => Input::get('contact_name'),
									'theme' => Input::get('theme'),									
								  );
				Log::info('Sending mail');						
				Mail::send('emails.submitproposal', ['emailData' => $emailData], function ($m) use ($emailData) {					
					$m->from($emailData['emailFrom'], 'SfcAsia Application');
					$m->to($emailData['emailTo'], 'SfcAsia')->subject('New Proposal Submitted');
					$m->attach($emailData['filePath']);			 
				});					
			}else{
				Log::Error('Zip File failed');													
				return 'File zip upload failed, please try again';
			}
			Log::info('Deleting file');						
			unlink($destFolder.$fileName);			
		}else{
			Log::Error('File upload failed');									
			return 'File upload failed, please try again';
		}
		Log::info('Saving log');
		$proposal = new Proposal;
        $proposal->origanisation_name= $data['organisation_name'];
        $proposal->contact_name= $data['contact_name'];
        $proposal->theme= $data['theme'];
		$proposal->file_name= $zipFilename;
		$proposal->ip_addr= $request->ip();
        $proposal->save();
		Log::info('Submit Proposal End');
		return redirect()->route('frontend.submitsuccess');
	}
	
	public function submitSuccess(){
		return view('frontend.submitsuccess');		
	}
}
