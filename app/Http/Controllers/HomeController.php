<?php

namespace App\Http\Controllers;
use App\Job;
use App\Request as Req;
use App\User;
use Validator;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('approved' , 1)->paginate(10);
        return view('home' , compact('jobs'));
    }


    public function job_details($id)
    {

        $job = Job::find($id);

        if($job->approved != 1)
        {
            return abort(404);
        }

        if(Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id , 'status' => 0 ])->exists() || Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id , 'status' => 2 ])->exists())
        {
            $button = 0;
        }
        else
        {
            $button = 1;
        }

        if(Req::where(['job_id' => $id , 'status' => 1])->exists())
        {
            $jobclosed = 1;
        }
        else
        {
            $jobclosed = 0;
        }

        if(Req::where(['job_id' => $id ,'freelancer_id' => Auth::id(), 'status' => 1])->exists())
        {
            $yourjob = 1;
        }
        else
        {
            $yourjob = 0;
        }


        return view('jobdetails' , compact('job' , 'button' , 'jobclosed' , 'yourjob'));
    }



    public function userdetails($id)
    {
        $user = User::find($id);
        if($user->hasRole('admin'))
        {
            return abort(404);
        }
        return view('userdetails' , compact('user'));
    }


    public function about()
    {
        return view('about');
    }




    public function contact()
    {
        return view('contact');
    }


    public function store_contact(Request $request)
    {
        if(Auth::user())
        {
            $validator = Validator::make($request->all() , [
                'body' => 'required|min:10'
            ]);
        }
        else
        {
            $validator = Validator::make($request->all() , [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'body' => 'required|min:10'
            ]);
        }

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(Auth::user())
        {
            $contact = new Contact;
            $contact->user_id = Auth::id();
            $contact->name = Auth::user()->name;
            $contact->email = Auth::user()->email;
            $contact->body = $request->input('body');
            $contact->save();
        }
        else
        {
            $contact = new Contact;
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->body = $request->input('body');
            $contact->save();
        }

        $request->session()->flash('status' , 'You\'re message has been sent ' );
        return redirect()->back();
    }


}
